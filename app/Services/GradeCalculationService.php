<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\GradeWeight;
use App\Models\TeacherClassSubject;
use Illuminate\Support\Collection;

class GradeCalculationService
{
    public function getAssessmentAverages(
        Collection $grades
    ): Collection {
        return $grades
            ->groupBy('assessment_type')
            ->map(function (Collection $items) {
                return round(
                    $items->avg('score'),
                    2
                );
            });
    }

    public function calculateFinalScore(
        Collection $grades,
        TeacherClassSubject $assignment
    ): ?float {
        $weights = GradeWeight::where(
            'academic_year_id',
            $assignment->academic_year_id
        )
            ->get()
            ->keyBy('assessment_type');

        if ($weights->isEmpty()) {
            return null;
        }

        $averages = $this->getAssessmentAverages($grades);

        $total = 0;
        $totalWeight = 0;

        foreach ($weights as $type => $weight) {

            $weightValue = (float) $weight->weight;

            if ($weightValue <= 0) {
                continue;
            }

            if (!$averages->has($type)) {
                continue;
            }

            $score = (float) $averages->get($type);

            $total += $score * ($weightValue / 100);

            $totalWeight += $weightValue;
        }

        if ($totalWeight <= 0) {
            return null;
        }

        $finalScore = ($total / $totalWeight) * 100;

        return round($finalScore, 2);
    }

    public function getStudentGrades(
        int $studentId,
        int $assignmentId
    ): Collection {
        return Grade::query()
            ->where('student_id', $studentId)
            ->where('teacher_class_subject_id', $assignmentId)
            ->orderBy('assessment_type')
            ->orderBy('assessment_name')
            ->get();
    }
}