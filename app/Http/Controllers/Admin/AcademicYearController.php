<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    /**
     * Daftar tahun ajaran
     */
    public function index()
    {
        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderBy('semester')
            ->get();

        return view(
            'admin.academic-years.index',
            compact('academicYears')
        );
    }

    /**
     * Form tambah tahun ajaran
     */
    public function create()
    {
        return view('admin.academic-years.create');
    }

    /**
     * Simpan tahun ajaran baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'semester' => [
                'required',
                Rule::in([
                    'Ganjil',
                    'Genap',
                ]),
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'registration_open' => [
                'nullable',
                'boolean',
            ],

            'course_selection_open' => [
                'nullable',
                'boolean',
            ],
        ], [
            'name.regex' =>
                'Format tahun ajaran harus seperti 2026/2027.',

            'end_date.after_or_equal' =>
                'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI CHECKBOX
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['registration_open'] =
            $request->boolean('registration_open');

        $validated['course_selection_open'] =
            $request->boolean('course_selection_open');

        /*
        |--------------------------------------------------------------------------
        | CEGAH DUPLIKAT TAHUN AJARAN + SEMESTER
        |--------------------------------------------------------------------------
        */

        $exists = AcademicYear::query()
            ->where('name', $validated['name'])
            ->where('semester', $validated['semester'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' =>
                        'Tahun ajaran dan semester tersebut sudah terdaftar.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | JIKA AKTIF, NONAKTIFKAN SEMUA TAHUN AJARAN LAIN
        |--------------------------------------------------------------------------
        */

        if ($validated['is_active']) {
            AcademicYear::query()
                ->where('is_active', true)
                ->update([
                    'is_active' => false,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        AcademicYear::create($validated);

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                'Tahun ajaran berhasil ditambahkan.'
            );
    }

    /**
     * Form edit tahun ajaran
     */
    public function edit(AcademicYear $academicYear)
    {
        return view(
            'admin.academic-years.edit',
            compact('academicYear')
        );
    }

    /**
     * Update tahun ajaran
     */
    public function update(
        Request $request,
        AcademicYear $academicYear
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'semester' => [
                'required',
                Rule::in([
                    'Ganjil',
                    'Genap',
                ]),
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'registration_open' => [
                'nullable',
                'boolean',
            ],

            'course_selection_open' => [
                'nullable',
                'boolean',
            ],
        ], [
            'name.regex' =>
                'Format tahun ajaran harus seperti 2026/2027.',

            'end_date.after_or_equal' =>
                'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | NORMALISASI CHECKBOX
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['registration_open'] =
            $request->boolean('registration_open');

        $validated['course_selection_open'] =
            $request->boolean('course_selection_open');

        /*
        |--------------------------------------------------------------------------
        | CEGAH DUPLIKAT KECUALI DATA SENDIRI
        |--------------------------------------------------------------------------
        */

        $exists = AcademicYear::query()
            ->where('name', $validated['name'])
            ->where('semester', $validated['semester'])
            ->where('id', '!=', $academicYear->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'name' =>
                        'Tahun ajaran dan semester tersebut sudah terdaftar.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | JIKA AKTIF, NONAKTIFKAN SEMUA YANG LAIN
        |--------------------------------------------------------------------------
        */

        if ($validated['is_active']) {
            AcademicYear::query()
                ->where('id', '!=', $academicYear->id)
                ->where('is_active', true)
                ->update([
                    'is_active' => false,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $academicYear->update($validated);

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                'Tahun ajaran berhasil diperbarui.'
            );
    }

    /**
     * Aktifkan tahun ajaran
     */
    public function activate(AcademicYear $academicYear)
    {
        /*
        |--------------------------------------------------------------------------
        | NONAKTIFKAN SEMUA YANG LAIN
        |--------------------------------------------------------------------------
        */

        AcademicYear::query()
            ->where('id', '!=', $academicYear->id)
            ->update([
                'is_active' => false,
            ]);

        /*
        |--------------------------------------------------------------------------
        | AKTIFKAN YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        $academicYear->update([
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                "Tahun ajaran {$academicYear->name} ({$academicYear->semester}) sekarang aktif."
            );
    }

    /**
     * Buka / tutup pendaftaran siswa
     */
    public function toggleRegistration(
        AcademicYear $academicYear
    ) {
        $academicYear->update([
            'registration_open' =>
                !$academicYear->registration_open,
        ]);

        return back()->with(
            'success',
            $academicYear->registration_open
                ? 'Pendaftaran siswa berhasil dibuka.'
                : 'Pendaftaran siswa berhasil ditutup.'
        );
    }

    /**
     * Buka / tutup pemilihan mata pelajaran
     */
    public function toggleCourseSelection(
        AcademicYear $academicYear
    ) {
        $academicYear->update([
            'course_selection_open' =>
                !$academicYear->course_selection_open,
        ]);

        return back()->with(
            'success',
            $academicYear->course_selection_open
                ? 'Pemilihan mata pelajaran berhasil dibuka.'
                : 'Pemilihan mata pelajaran berhasil ditutup.'
        );
    }

    /**
     * Hapus tahun ajaran
     */
    public function destroy(AcademicYear $academicYear)
    {
        /*
        |--------------------------------------------------------------------------
        | JANGAN HAPUS TAHUN AJARAN AKTIF
        |--------------------------------------------------------------------------
        */

        if ($academicYear->is_active) {
            return redirect()
                ->route('admin.academic-years.index')
                ->withErrors([
                    'delete' =>
                        'Tahun ajaran yang sedang aktif tidak dapat dihapus.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS
        |--------------------------------------------------------------------------
        */

        $academicYear->delete();

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                'Tahun ajaran berhasil dihapus.'
            );
    }
}
