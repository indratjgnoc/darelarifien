<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with([
            'academicYear',
            'schoolClass',
            'user',
        ]);

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('school_class_id')) {
            $query->where('school_class_id', $request->school_class_id);
        }

        $students = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $academicYears = AcademicYear::orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $classes = SchoolClass::with('academicYear')
            ->orderBy('name')
            ->get();

        return view('admin.students.index', compact(
            'students',
            'academicYears',
            'classes'
        ));
    }

    public function create()
    {
        $academicYears = AcademicYear::orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $classes = SchoolClass::with('academicYear')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.students.create', compact(
            'academicYears',
            'classes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => [
                'required',
                'string',
                'max:50',
                'unique:students,nis',
            ],
            'nisn' => [
                'nullable',
                'string',
                'max:50',
                'unique:students,nisn',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'gender' => [
                'nullable',
                Rule::in(['L', 'P']),
            ],
            'birth_place' => [
                'nullable',
                'string',
                'max:100',
            ],
            'birth_date' => [
                'nullable',
                'date',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'father_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'mother_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'guardian_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'parent_phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],
            'school_class_id' => [
                'nullable',
                'exists:school_classes,id',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $validated['name'] = trim($validated['name']);
        $validated['nis'] = trim($validated['nis']);
        $validated['nisn'] = isset($validated['nisn'])
            ? trim($validated['nisn'])
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        Student::create($validated);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student->load([
            'academicYear',
            'schoolClass.homeroomTeacher',
            'user',
        ]);

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $academicYears = AcademicYear::orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $classes = SchoolClass::with('academicYear')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.students.edit', compact(
            'student',
            'academicYears',
            'classes'
        ));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nis' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'nis')->ignore($student->id),
            ],
            'nisn' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('students', 'nisn')->ignore($student->id),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'gender' => [
                'nullable',
                Rule::in(['L', 'P']),
            ],
            'birth_place' => [
                'nullable',
                'string',
                'max:100',
            ],
            'birth_date' => [
                'nullable',
                'date',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'father_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'mother_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'guardian_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'parent_phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],
            'school_class_id' => [
                'nullable',
                'exists:school_classes,id',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $validated['name'] = trim($validated['name']);
        $validated['nis'] = trim($validated['nis']);
        $validated['nisn'] = isset($validated['nisn'])
            ? trim($validated['nisn'])
            : null;

        $validated['is_active'] = $request->boolean('is_active');

        $student->update($validated);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        if ($student->user) {
            $student->user->delete();
        }

        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data santri berhasil dihapus.');
    }

    /**
     * Membuat akun login santri.
     */
    public function createAccount(Student $student)
    {
        if ($student->user) {
            return back()->with(
                'error',
                'santri ini sudah memiliki akun login.'
            );
        }

        $email = 'santri' . $student->nis . '@darelarifien.sch.id';

        if (User::where('email', $email)->exists()) {
            return back()->with(
                'error',
                'Email akun santri sudah digunakan.'
            );
        }

        DB::transaction(function () use ($student, $email) {
            $user = User::create([
                'name' => $student->name,
                'email' => $email,
                'password' => Hash::make($student->nis),
                'role' => 'santri',
            ]);

            $student->update([
                'user_id' => $user->id,
            ]);
        });

        return back()->with(
            'success',
            "Akun santri berhasil dibuat. Email: {$email} | Password awal: {$student->nis}"
        );
    }
}
