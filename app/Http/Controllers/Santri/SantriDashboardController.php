<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class SantriDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = Student::where('user_id', $user->id)
            ->with([
                'academicYear',
                'schoolClass.homeroomTeacher',
            ])
            ->first();

        return view('santri.dashboard', compact('user', 'student'));
    }

    public function profile()
    {
        $user = Auth::user();

        $student = Student::where('user_id', $user->id)
            ->with([
                'academicYear',
                'schoolClass.homeroomTeacher',
            ])
            ->firstOrFail();

        return view('santri.profile', compact('user', 'student'));
    }
}