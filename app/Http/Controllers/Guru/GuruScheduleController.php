<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class GuruScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA GURU
        |--------------------------------------------------------------------------
        */

        $teacher = $user->teacher;

        /*
        |--------------------------------------------------------------------------
        | JIKA AKUN BELUM TERHUBUNG KE DATA GURU
        |--------------------------------------------------------------------------
        */

        if (!$teacher) {
            return view('guru.schedules.index', [
                'teacher' => null,
                'schedules' => collect(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL JADWAL GURU
        |--------------------------------------------------------------------------
        */

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

        return view(
            'guru.schedules.index',
            compact(
                'teacher',
                'schedules'
            )
        );
    }
}