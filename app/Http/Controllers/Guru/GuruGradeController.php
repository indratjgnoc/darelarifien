<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeWeight;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherClassSubject;
use App\Services\GradeCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruGradeController extends Controller
{
    /**
     * Daftar penugasan guru.
     */
    public function assignments()
    {
        $teacher = Teacher::where('user_id', Auth::id())
            ->firstOrFail();

        $assignments = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'subject',
        ])
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->whereHas('schoolClass', function ($query) {
                $query->where('is_active', true);
            })
            ->whereHas('subject', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('academic_year_id')
            ->orderBy('school_class_id')
            ->get();

        return view(
            'guru.grades.assignments',
            compact(
                'teacher',
                'assignments'
            )
        );
    }

    /**
     * Halaman input dan riwayat nilai.
     */
    public function index(int $assignmentId)
    {
        $teacher = Teacher::where('user_id', Auth::id())
            ->firstOrFail();

        $assignment = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'subject',
            'teacher',
        ])
            ->where('id', $assignmentId)
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $students = Student::where(
            'school_class_id',
            $assignment->school_class_id
        )
            ->where(
                'academic_year_id',
                $assignment->academic_year_id
            )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $grades = Grade::with('student')
            ->where(
                'teacher_class_subject_id',
                $assignment->id
            )
            ->whereIn(
                'student_id',
                $students->pluck('id')
            )
            ->orderBy('assessment_type')
            ->orderBy('assessment_name')
            ->orderBy('student_id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Daftar penilaian yang sudah dibuat
        |--------------------------------------------------------------------------
        */

        $assessments = $grades
            ->groupBy(function ($grade) {
                return $grade->assessment_type . '|' .
                    $grade->assessment_name;
            })
            ->map(function ($group) {

                $first = $group->first();

                return (object) [
                    'type' => $first->assessment_type,
                    'name' => $first->assessment_name,
                    'count' => $group->count(),
                    'average' => round(
                        $group->avg('score'),
                        2
                    ),
                ];
            })
            ->values();

        return view(
            'guru.grades.index',
            compact(
                'teacher',
                'assignment',
                'students',
                'grades',
                'assessments'
            )
        );
    }

    public function summary(
        int $assignmentId,
        GradeCalculationService $calculator
    ) {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $assignment = TeacherClassSubject::query()
            ->with([
                'academicYear',
                'schoolClass',
                'subject',
                'teacher',
            ])
            ->where('id', $assignmentId)
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $students = Student::query()
            ->where('school_class_id', $assignment->school_class_id)
            ->where('academic_year_id', $assignment->academic_year_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $grades = Grade::query()
            ->where('teacher_class_subject_id', $assignment->id)
            ->whereIn('student_id', $students->pluck('id'))
            ->get()
            ->groupBy('student_id');

        $weights = GradeWeight::query()
            ->where('academic_year_id', $assignment->academic_year_id)
            ->orderByRaw("
            CASE assessment_type
                WHEN 'Tugas' THEN 1
                WHEN 'Kuis' THEN 2
                WHEN 'Praktik' THEN 3
                WHEN 'UTS' THEN 4
                WHEN 'UAS' THEN 5
                ELSE 6
            END
        ")
            ->get();

        $summaries = $students->map(function ($student) use (
            $grades,
            $assignment,
            $calculator
        ) {
            $studentGrades = $grades->get(
                $student->id,
                collect()
            );

            $averages = $calculator->getAssessmentAverages(
                $studentGrades
            );

            $finalScore = $calculator->calculateFinalScore(
                $studentGrades,
                $assignment
            );

            return (object) [
                'student' => $student,

                'averages' => $averages,

                'final_score' => $finalScore,
            ];
        });

        return view('guru.grades.summary', [
            'teacher' => $teacher,
            'assignment' => $assignment,
            'students' => $students,
            'summaries' => $summaries,
            'weights' => $weights,
        ]);
    }

    public function editAssessment(
        int $assignmentId,
        string $type,
        string $name
    ) {
        $teacher = Teacher::where('user_id', Auth::id())
            ->firstOrFail();

        $assignment = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'subject',
        ])
            ->where('id', $assignmentId)
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $students = Student::where(
            'school_class_id',
            $assignment->school_class_id
        )
            ->where(
                'academic_year_id',
                $assignment->academic_year_id
            )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $grades = Grade::where(
            'teacher_class_subject_id',
            $assignment->id
        )
            ->where('assessment_type', $type)
            ->where('assessment_name', $name)
            ->whereIn(
                'student_id',
                $students->pluck('id')
            )
            ->get()
            ->keyBy('student_id');

        if ($grades->isEmpty()) {
            abort(404, 'Penilaian tidak ditemukan.');
        }

        return view(
            'guru.grades.edit-assessment',
            compact(
                'teacher',
                'assignment',
                'students',
                'grades',
                'type',
                'name'
            )
        );
    }

    public function updateAssessment(
        Request $request,
        int $assignmentId,
        string $type,
        string $name
    ) {
        $teacher = Teacher::where('user_id', Auth::id())
            ->firstOrFail();

        $assignment = TeacherClassSubject::where('id', $assignmentId)
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'assessment_type' => [
                'required',
                'in:Tugas,Kuis,Praktik,UTS,UAS,Lainnya',
            ],

            'assessment_name' => [
                'required',
                'string',
                'max:150',
            ],

            'scores' => [
                'required',
                'array',
            ],

            'scores.*' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $students = Student::where(
            'school_class_id',
            $assignment->school_class_id
        )
            ->where(
                'academic_year_id',
                $assignment->academic_year_id
            )
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        foreach (array_keys($validated['scores']) as $studentId) {
            if (! $students->has((int) $studentId)) {
                abort(
                    403,
                    'Terdapat santri yang tidak termasuk dalam kelas ini.'
                );
            }
        }

        DB::transaction(function () use (
            $validated,
            $assignment,
            $type,
            $name
        ) {

            foreach ($validated['scores'] as $studentId => $score) {

                $grade = Grade::where(
                    'teacher_class_subject_id',
                    $assignment->id
                )
                    ->where(
                        'student_id',
                        (int) $studentId
                    )
                    ->where(
                        'assessment_type',
                        $type
                    )
                    ->where(
                        'assessment_name',
                        $name
                    )
                    ->first();

                if (! $grade) {
                    continue;
                }

                /*
             * Jika nilai dikosongkan,
             * hapus nilai santri tersebut.
             */
                if ($score === null || $score === '') {
                    $grade->delete();
                    continue;
                }

                $grade->update([
                    'assessment_type' =>
                    $validated['assessment_type'],

                    'assessment_name' =>
                    $validated['assessment_name'],

                    'score' => $score,

                    'notes' =>
                    $validated['notes'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route(
                'guru.grades.index',
                $assignment->id
            )
            ->with(
                'success',
                'Penilaian berhasil diperbarui.'
            );
    }

    public function destroyAssessment(
        int $assignmentId,
        string $type,
        string $name
    ) {
        $teacher = Teacher::where('user_id', Auth::id())
            ->firstOrFail();

        $assignment = TeacherClassSubject::where('id', $assignmentId)
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $deleted = Grade::where(
            'teacher_class_subject_id',
            $assignment->id
        )
            ->where('assessment_type', $type)
            ->where('assessment_name', $name)
            ->delete();

        if ($deleted === 0) {
            return back()->with(
                'error',
                'Penilaian tidak ditemukan.'
            );
        }

        return back()->with(
            'success',
            'Penilaian beserta nilai santri berhasil dihapus.'
        );
    }

    public function store(
        Request $request,
        int $assignmentId
    ) {
        $teacher = Teacher::where('user_id', Auth::id())
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Pastikan assignment memang milik guru
        |--------------------------------------------------------------------------
        */

        $assignment = TeacherClassSubject::where('id', $assignmentId)
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validasi request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'assessment_type' => [
                'required',
                'in:Tugas,Kuis,Praktik,UTS,UAS,Lainnya',
            ],

            'assessment_name' => [
                'required',
                'string',
                'max:150',
            ],

            'scores' => [
                'required',
                'array',
            ],

            'scores.*' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil santri yang memang berada di kelas assignment
        |--------------------------------------------------------------------------
        */

        $students = Student::where(
            'school_class_id',
            $assignment->school_class_id
        )
            ->where(
                'academic_year_id',
                $assignment->academic_year_id
            )
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        /*
        |--------------------------------------------------------------------------
        | Validasi ID santri dari request
        |--------------------------------------------------------------------------
        */

        foreach (array_keys($validated['scores']) as $studentId) {

            if (! $students->has((int) $studentId)) {

                abort(
                    403,
                    'Terdapat santri yang tidak termasuk dalam kelas ini.'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan dalam transaction
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $assignment
        ) {

            foreach (
                $validated['scores']
                as $studentId => $score
            ) {

                /*
                |--------------------------------------------------------------------------
                | Kosong = jangan membuat/mengubah nilai
                |--------------------------------------------------------------------------
                */

                if (
                    $score === null ||
                    $score === ''
                ) {
                    continue;
                }

                Grade::updateOrCreate(
                    [
                        'student_id' => (int) $studentId,

                        'teacher_class_subject_id' =>
                        $assignment->id,

                        'assessment_type' =>
                        $validated['assessment_type'],

                        'assessment_name' =>
                        $validated['assessment_name'],
                    ],
                    [
                        'score' => $score,

                        'notes' =>
                        $validated['notes'] ?? null,
                    ]
                );
            }
        });

        return back()->with(
            'success',
            'Nilai berhasil disimpan.'
        );
    }
}
