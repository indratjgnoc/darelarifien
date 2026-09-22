<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruGradeController extends Controller
{
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

        $grades = Grade::with([
            'student',
            'teacherClassSubject.subject',
            'teacherClassSubject.schoolClass',
        ])
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

        return view(
            'guru.grades.index',
            compact(
                'teacher',
                'assignment',
                'students',
                'grades'
            )
        );
    }


    public function store(
        Request $request,
        int $assignmentId
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
            $assignment
        ) {

            foreach ($validated['scores'] as $studentId => $score) {

                /*
                | Kosong = jangan simpan
                */
                if ($score === null || $score === '') {
                    continue;
                }

                Grade::updateOrCreate(
                    [
                        'student_id' => (int) $studentId,
                        'teacher_class_subject_id' => $assignment->id,
                        'assessment_type' => $validated['assessment_type'],
                        'assessment_name' => $validated['assessment_name'],
                    ],
                    [
                        'score' => $score,
                        'notes' => $validated['notes'] ?? null,
                    ]
                );
            }
        });

        return back()->with(
            'success',
            'Nilai seluruh santri berhasil disimpan.'
        );
    }
}
