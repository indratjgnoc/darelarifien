<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class GuruClassController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $teacher = $user->teacher;

        if (!$teacher) {
            return view('guru.classes.index', [
                'teacher' => null,
                'classes' => collect(),
            ]);
        }

        $classes = Schedule::query()
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->orderBy('class_name')
            ->orderBy('day')
            ->orderBy('start_time')
            ->get()
            ->groupBy('class_name');

        return view(
            'guru.classes.index',
            compact(
                'teacher',
                'classes'
            )
        );
    }
}