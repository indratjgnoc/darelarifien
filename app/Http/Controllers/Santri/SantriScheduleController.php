<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class SantriScheduleController extends Controller
{

    public function index()
    {

        $student = Student::with([
            'academicYear',
            'schoolClass',
        ])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $schedules = Schedule::with([
            'teacherClassSubject.academicYear',
            'teacherClassSubject.schoolClass',
            'teacherClassSubject.teacher',
            'teacherClassSubject.subject',
        ])
            ->where('is_active', true)
            ->whereHas('teacherClassSubject', function ($query) use ($student) {

                $query
                    ->where('school_class_id', $student->school_class_id)
                    ->where('academic_year_id', $student->academic_year_id)
                    ->where('is_active', true);

            })
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

        return view(
            'santri.schedules.index',
            compact(
                'student',
                'schedules'
            )
        );
    }
}