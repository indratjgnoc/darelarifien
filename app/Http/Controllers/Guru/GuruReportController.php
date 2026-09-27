<?php

namespace App\Http\Controllers\Guru;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeWeight;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\TeacherClassSubject;
use Illuminate\Support\Facades\Auth;

class GuruReportController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $classes = SchoolClass::query()
            ->with([
                'academicYear',
            ])
            ->where('homeroom_teacher_id', $teacher->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('guru.reports.index', [
            'teacher' => $teacher,
            'classes' => $classes,
        ]);
    }

    public function classDetail(int $classId)
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $schoolClass = SchoolClass::query()
            ->with([
                'academicYear',
                'homeroomTeacher',
            ])
            ->where('id', $classId)
            ->where('homeroom_teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $students = Student::query()
            ->where('school_class_id', $schoolClass->id)
            ->where('academic_year_id', $schoolClass->academic_year_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $weights = GradeWeight::query()
            ->where('academic_year_id', $schoolClass->academic_year_id)
            ->where('weight', '>', 0)
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

        $requiredTypes = $weights
            ->pluck('assessment_type')
            ->values();

        $assignments = TeacherClassSubject::query()
            ->with([
                'teacher',
                'subject',
                'academicYear',
                'schoolClass',
            ])
            ->where('school_class_id', $schoolClass->id)
            ->where('academic_year_id', $schoolClass->academic_year_id)
            ->where('is_active', true)
            ->whereHas('teacher', function ($query) {
                $query->where('is_active', true);
            })
            ->whereHas('subject', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('subject_id')
            ->get();

        $assignmentIds = $assignments->pluck('id');

        $grades = Grade::query()
            ->whereIn('teacher_class_subject_id', $assignmentIds)
            ->whereIn('student_id', $students->pluck('id'))
            ->get();

        $gradeIndex = [];

        foreach ($grades as $grade) {
            $gradeIndex[$grade->teacher_class_subject_id][$grade->student_id][$grade->assessment_type] = true;
        }

        $subjects = $assignments->map(function ($assignment) use (
            $students,
            $requiredTypes,
            $gradeIndex
        ) {
            $missing = [];

            foreach ($requiredTypes as $type) {
                $missingStudents = [];

                foreach ($students as $student) {
                    $exists = $gradeIndex[$assignment->id][$student->id][$type] ?? false;

                    if (!$exists) {
                        $missingStudents[] = $student;
                    }
                }

                if (!empty($missingStudents)) {
                    $missing[] = [
                        'type' => $type,
                        'count' => count($missingStudents),
                        'students' => $missingStudents,
                    ];
                }
            }

            $isComplete = empty($missing);

            return (object) [
                'assignment' => $assignment,
                'subject' => $assignment->subject,
                'teacher' => $assignment->teacher,
                'is_complete' => $isComplete,
                'missing' => $missing,
            ];
        });

        $totalSubjects = $subjects->count();

        $completedSubjects = $subjects
            ->where('is_complete', true)
            ->count();

        $incompleteSubjects = $totalSubjects - $completedSubjects;

        $isReadyToPrint = (
            $totalSubjects > 0 &&
            $completedSubjects === $totalSubjects
        );

        return view('guru.reports.class', [
            'teacher' => $teacher,
            'schoolClass' => $schoolClass,
            'students' => $students,
            'weights' => $weights,
            'requiredTypes' => $requiredTypes,
            'subjects' => $subjects,
            'totalSubjects' => $totalSubjects,
            'completedSubjects' => $completedSubjects,
            'incompleteSubjects' => $incompleteSubjects,
            'isReadyToPrint' => $isReadyToPrint,
        ]);
    }

    public function print(int $classId)
    {
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            abort(403);
        }

        $schoolClass = SchoolClass::query()
            ->with([
                'academicYear',
                'homeroomTeacher',
            ])
            ->where('id', $classId)
            ->where('homeroom_teacher_id', $teacher->id)
            ->where('is_active', true)
            ->firstOrFail();

        $students = Student::query()
            ->where('school_class_id', $schoolClass->id)
            ->where('academic_year_id', $schoolClass->academic_year_id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        if ($students->isEmpty()) {
            abort(422, 'Belum ada santri aktif pada kelas ini.');
        }


        $weights = GradeWeight::query()
            ->where('academic_year_id', $schoolClass->academic_year_id)
            ->where('weight', '>', 0)
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

        $requiredTypes = $weights
            ->pluck('assessment_type')
            ->values();

        if ($requiredTypes->isEmpty()) {
            abort(422, 'Bobot penilaian belum tersedia.');
        }

        $assignments = TeacherClassSubject::query()
            ->with([
                'teacher',
                'subject',
                'academicYear',
                'schoolClass',
            ])
            ->where('school_class_id', $schoolClass->id)
            ->where('academic_year_id', $schoolClass->academic_year_id)
            ->where('is_active', true)
            ->whereHas('teacher', function ($query) {
                $query->where('is_active', true);
            })
            ->whereHas('subject', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('subject_id')
            ->get();

        if ($assignments->isEmpty()) {
            abort(422, 'Belum ada mata pelajaran untuk kelas ini.');
        }

        $grades = Grade::query()
            ->whereIn(
                'teacher_class_subject_id',
                $assignments->pluck('id')
            )
            ->whereIn(
                'student_id',
                $students->pluck('id')
            )
            ->get();

        foreach ($assignments as $assignment) {

            foreach ($students as $student) {

                $studentGrades = $grades
                    ->where('teacher_class_subject_id', $assignment->id)
                    ->where('student_id', $student->id);

                foreach ($requiredTypes as $type) {

                    $exists = $studentGrades
                        ->where('assessment_type', $type)
                        ->isNotEmpty();

                    if (!$exists) {

                        abort(
                            422,
                            "Nilai {$type} untuk {$student->name} pada mata pelajaran {$assignment->subject->name} belum lengkap."
                        );
                    }
                }
            }
        }

        $reportStudents = $students->map(function ($student) use (
            $assignments,
            $grades,
            $weights
        ) {

            $subjects = $assignments->map(function ($assignment) use (
                $student,
                $grades,
                $weights
            ) {

                $studentGrades = $grades
                    ->where('teacher_class_subject_id', $assignment->id)
                    ->where('student_id', $student->id);

                $averages = $studentGrades
                    ->groupBy('assessment_type')
                    ->map(function ($items) {
                        return round($items->avg('score'), 2);
                    });

                $total = 0;
                $totalWeight = 0;

                foreach ($weights as $weight) {

                    $weightValue = (float) $weight->weight;

                    if ($weightValue <= 0) {
                        continue;
                    }

                    if (!$averages->has($weight->assessment_type)) {
                        continue;
                    }

                    $score = (float) $averages->get(
                        $weight->assessment_type
                    );

                    $total += $score * ($weightValue / 100);

                    $totalWeight += $weightValue;
                }

                $finalScore = $totalWeight > 0
                    ? round(($total / $totalWeight) * 100, 2)
                    : 0;

                return (object) [
                    'assignment' => $assignment,
                    'subject' => $assignment->subject,
                    'teacher' => $assignment->teacher,
                    'averages' => $averages,
                    'final_score' => $finalScore,
                ];
            });

            return (object) [
                'student' => $student,
                'subjects' => $subjects,
            ];
        });

        $settings = Setting::pluck('value', 'key');

        $pdf = Pdf::loadView('guru.reports.pdf', [
            'schoolClass' => $schoolClass,
            'students' => $reportStudents,
            'weights' => $weights,
            'settings' => $settings,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'rapor-' .
                str_replace(' ', '-', strtolower($schoolClass->name)) .
                '.pdf'
        );
    }
}
