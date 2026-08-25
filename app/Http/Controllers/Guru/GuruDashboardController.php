<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $teacher = $user->teacher;

        $schedules = collect();

        if ($teacher) {
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
                    END
                ")
                ->orderBy('start_time')
                ->get();
        }

        return view('guru.dashboard', compact(
            'user',
            'teacher',
            'schedules'
        ));
    }
}