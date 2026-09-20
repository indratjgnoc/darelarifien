<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherClassSubject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherClassSubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = TeacherClassSubject::with([
            'academicYear',
            'schoolClass',
            'teacher',
            'subject',
        ]);

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('school_class_id')) {
            $query->where('school_class_id', $request->school_class_id);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $assignments = $query
            ->orderByDesc('academic_year_id')
            ->orderBy('school_class_id')
            ->orderBy('teacher_id')
            ->paginate(15)
            ->withQueryString();

        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $classes = SchoolClass::query()
            ->with('academicYear')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $subjects = Subject::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.teacher-class-subjects.index', compact(
            'assignments',
            'academicYears',
            'classes',
            'teachers',
            'subjects'
        ));
    }

    public function create()
    {
        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $activeAcademicYear = AcademicYear::query()
            ->where('is_active', true)
            ->first();

        $classes = SchoolClass::query()
            ->with('academicYear')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $subjects = Subject::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.teacher-class-subjects.create', compact(
            'academicYears',
            'activeAcademicYear',
            'classes',
            'teachers',
            'subjects'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'credit' => ['required', 'integer', 'min:1', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
        ]);

        $exists = TeacherClassSubject::query()
            ->where('academic_year_id', $validated['academic_year_id'])
            ->where('school_class_id', $validated['school_class_id'])
            ->where('teacher_id', $validated['teacher_id'])
            ->where('subject_id', $validated['subject_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' => 'Penugasan guru, kelas, dan mata pelajaran tersebut sudah ada.',
                ]);
        }

        $validated['is_active'] = $request->boolean('is_active');

        TeacherClassSubject::create($validated);

        return redirect()
            ->route('admin.teacher-class-subjects.index')
            ->with('success', 'Penugasan guru berhasil ditambahkan.');
    }

    public function edit(TeacherClassSubject $teacherClassSubject)
    {
        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $classes = SchoolClass::query()
            ->with('academicYear')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $subjects = Subject::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.teacher-class-subjects.edit', compact(
            'teacherClassSubject',
            'academicYears',
            'classes',
            'teachers',
            'subjects'
        ));
    }

    public function update(
        Request $request,
        TeacherClassSubject $teacherClassSubject
    ) {
        $validated = $request->validate([
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'credit' => ['required', 'integer', 'min:1', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
        ]);

        $exists = TeacherClassSubject::query()
            ->where('academic_year_id', $validated['academic_year_id'])
            ->where('school_class_id', $validated['school_class_id'])
            ->where('teacher_id', $validated['teacher_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('id', '!=', $teacherClassSubject->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_id' => 'Penugasan guru, kelas, dan mata pelajaran tersebut sudah ada.',
                ]);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $teacherClassSubject->update($validated);

        return redirect()
            ->route('admin.teacher-class-subjects.index')
            ->with('success', 'Penugasan guru berhasil diperbarui.');
    }

    public function destroy(TeacherClassSubject $teacherClassSubject)
    {
        $teacherClassSubject->delete();

        return redirect()
            ->route('admin.teacher-class-subjects.index')
            ->with('success', 'Penugasan guru berhasil dihapus.');
    }
}