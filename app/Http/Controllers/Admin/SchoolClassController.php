<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    |
    | Menampilkan daftar seluruh kelas.
    |
    */

    public function index()
    {
        $classes = SchoolClass::with([
            'academicYear',
            'homeroomTeacher',
        ])
            ->orderBy('sort_order')
            ->orderBy('level')
            ->orderBy('name')
            ->get();

        return view(
            'admin.classes.index',
            compact('classes')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    |
    | Form tambah kelas.
    |
    */

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Tahun ajaran aktif
        |--------------------------------------------------------------------------
        */

        $activeAcademicYear = AcademicYear::query()
            ->where('is_active', true)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Semua tahun ajaran
        |--------------------------------------------------------------------------
        */

        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderBy('semester')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Guru aktif
        |--------------------------------------------------------------------------
        */

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.classes.create',
            compact(
                'activeAcademicYear',
                'academicYears',
                'teachers'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    |
    | Menyimpan kelas baru.
    |
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'level' => [
                'required',
                'string',
                'max:50',
            ],

            'homeroom_teacher_id' => [
                'nullable',
                'exists:teachers,id',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI DATA
        |--------------------------------------------------------------------------
        */

        $validated['name'] = trim($validated['name']);

        $validated['level'] = trim($validated['level']);

        $validated['is_active'] =
            $request->boolean('is_active');

        /*
        |--------------------------------------------------------------------------
        | CEGAH KELAS DUPLIKAT
        |--------------------------------------------------------------------------
        |
        | Nama kelas yang sama tidak boleh berada dalam
        | tahun ajaran yang sama.
        |
        | Contoh:
        |
        | 2026/2027 Ganjil -> VII A
        | 2026/2027 Ganjil -> VII A
        |
        | Tidak diperbolehkan.
        |
        */

        $exists = SchoolClass::query()
            ->where(
                'academic_year_id',
                $validated['academic_year_id']
            )
            ->whereRaw(
                'LOWER(name) = ?',
                [strtolower($validated['name'])]
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' =>
                        'Kelas dengan nama tersebut sudah ada pada tahun ajaran ini.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CEGAH GURU MENJADI WALI KELAS GANDA
        |--------------------------------------------------------------------------
        |
        | Satu guru hanya boleh menjadi wali kelas satu kelas
        | dalam satu tahun ajaran.
        |
        */

        if (!empty($validated['homeroom_teacher_id'])) {

            $teacherAlreadyHomeroom = SchoolClass::query()
                ->where(
                    'academic_year_id',
                    $validated['academic_year_id']
                )
                ->where(
                    'homeroom_teacher_id',
                    $validated['homeroom_teacher_id']
                )
                ->exists();

            if ($teacherAlreadyHomeroom) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'homeroom_teacher_id' =>
                            'Guru tersebut sudah menjadi wali kelas pada tahun ajaran ini.',
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA
        |--------------------------------------------------------------------------
        */

        SchoolClass::create($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with(
                'success',
                'Kelas berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    |
    | Jika menggunakan Route::resource(), method ini diperlukan.
    | Kita arahkan ke halaman edit karena tidak ada halaman detail khusus.
    |
    */

    public function show(SchoolClass $class)
    {
        return redirect()
            ->route(
                'admin.classes.edit',
                $class
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    |
    | Form edit kelas.
    |
    */

    public function edit(SchoolClass $class)
    {
        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderBy('semester')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.classes.edit',
            compact(
                'class',
                'academicYears',
                'teachers'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    |
    | Memperbarui data kelas.
    |
    */

    public function update(
        Request $request,
        SchoolClass $class
    ) {
        $validated = $request->validate([

            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'level' => [
                'required',
                'string',
                'max:50',
            ],

            'homeroom_teacher_id' => [
                'nullable',
                'exists:teachers,id',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI DATA
        |--------------------------------------------------------------------------
        */

        $validated['name'] = trim($validated['name']);

        $validated['level'] = trim($validated['level']);

        $validated['is_active'] =
            $request->boolean('is_active');

        /*
        |--------------------------------------------------------------------------
        | CEGAH KELAS DUPLIKAT
        |--------------------------------------------------------------------------
        |
        | Kelas yang sedang diedit harus dikecualikan dari pengecekan.
        |
        */

        $exists = SchoolClass::query()
            ->where(
                'academic_year_id',
                $validated['academic_year_id']
            )
            ->whereRaw(
                'LOWER(name) = ?',
                [strtolower($validated['name'])]
            )
            ->where(
                'id',
                '!=',
                $class->id
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' =>
                        'Kelas dengan nama tersebut sudah ada pada tahun ajaran ini.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CEGAH WALI KELAS GANDA
        |--------------------------------------------------------------------------
        |
        | Kelas yang sedang diedit harus dikecualikan dari pengecekan.
        |
        */

        if (!empty($validated['homeroom_teacher_id'])) {

            $teacherAlreadyHomeroom = SchoolClass::query()
                ->where(
                    'academic_year_id',
                    $validated['academic_year_id']
                )
                ->where(
                    'homeroom_teacher_id',
                    $validated['homeroom_teacher_id']
                )
                ->where(
                    'id',
                    '!=',
                    $class->id
                )
                ->exists();

            if ($teacherAlreadyHomeroom) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'homeroom_teacher_id' =>
                            'Guru tersebut sudah menjadi wali kelas pada tahun ajaran ini.',
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $class->update($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with(
                'success',
                'Kelas berhasil diperbarui.'
            );
    }

    //HAPUS

    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with(
                'success',
                'Kelas berhasil dihapus.'
            );
    }
}
