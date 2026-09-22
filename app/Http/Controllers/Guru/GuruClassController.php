<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherClassSubject;
use Illuminate\Support\Facades\Auth;

class GuruClassController extends Controller
{

    public function index()
    {
        $teacher = Teacher::where('user_id', Auth::id())
            ->first();

        if (!$teacher) {
            return view('guru.classes.index', [
                'teacher' => null,
                'classes' => collect(),
            ]);
        }

        $classes = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'subject',
        ])
            ->where('teacher_id', $teacher->id)
            ->where('is_active', true)
            ->whereHas('schoolClass', function ($query) {
                $query->where('is_active', true);
            })
            ->get()
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

        return view(
            'guru.classes.index',
            compact(
                'teacher',
                'classes'
            )
        );
    }

    public function show(int $id)
    {
        $teacher = Teacher::where('user_id', Auth::id())
            ->first();

        if (!$teacher) {
            abort(403, 'Akun guru tidak ditemukan.');
        }

        $assignments = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'subject',
        ])
            ->where('teacher_id', $teacher->id)
            ->where('school_class_id', $id)
            ->where('is_active', true)
            ->whereHas('schoolClass', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        if ($assignments->isEmpty()) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini.');
        }

        $schoolClass = $assignments->first()->schoolClass;

        return view(
            'guru.classes.show',
            compact(
                'teacher',
                'schoolClass',
                'assignments'
            )
        );
    }
}
