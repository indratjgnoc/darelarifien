<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherClassSubject;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $teacher = Teacher::where('user_id', $user->id)
            ->first();

        $assignments = collect();
        $classes = collect();
        $schedules = collect();

        if ($teacher) {

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
                ->get();

            $classes = $assignments
                ->filter(fn ($assignment) => $assignment->schoolClass)
                ->groupBy(function ($assignment) {
                    return $assignment->academic_year_id . '-' .
                        $assignment->school_class_id;
                })
                ->map(function ($group) {
                    $first = $group->first();

                    return (object) [
                        'academic_year' => $first->academicYear,
                        'school_class' => $first->schoolClass,

                        'subjects' => $group
                            ->filter(fn ($item) => $item->subject)
                            ->unique('subject_id')
                            ->values(),
                    ];
                })
                ->values();

            $schedules = Schedule::query()
                ->where('teacher_id', $teacher->id)
                ->where('is_active', true)
                ->orderByRaw("
                    CASE day
                        WHEN 'Senin' THEN 1
                        WHEN 'Selasa' THEN 2
                        WHEN 'Rabu' THEN 3
                        WHEN 'Kamis' THEN 4
                        WHEN 'Jumat' THEN 5
                        WHEN 'Sabtu' THEN 6
                        WHEN 'Minggu' THEN 7
                        ELSE 8
                    END
                ")
                ->orderBy('start_time')
                ->get();
        }

        return view('guru.dashboard', compact(
            'user',
            'teacher',
            'assignments',
            'classes',
            'schedules'
        ));
    }
}
