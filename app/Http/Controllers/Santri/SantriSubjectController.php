<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TeacherClassSubject;
use Illuminate\Support\Facades\Auth;

class SantriSubjectController extends Controller
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

        $subjects = TeacherClassSubject::with([
            'subject',
            'teacher',
        ])
            ->where('school_class_id', $student->school_class_id)
            ->where('academic_year_id', $student->academic_year_id)
            ->where('is_active', true)
            ->get();

        return view('santri.subjects.index', compact(
            'user',
            'student',
            'subjects'
        ));
    }
}