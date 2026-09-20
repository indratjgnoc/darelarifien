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
        $user = Auth::user();

        $student = Student::with([
            'academicYear',
            'schoolClass',
        ])
            ->where('user_id', $user->id)
            ->firstOrFail();

        $schedules = Schedule::with('teacher')
            ->where('class_name', $student->schoolClass?->name)
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

        return view('santri.schedules.index', compact(
            'user',
            'student',
            'schedules'
        ));
    }
}