<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::query()
            ->orderByDesc('name')
            ->orderByRaw("
                CASE semester
                    WHEN 'ganjil' THEN 1
                    WHEN 'genap' THEN 2
                END
            ")
            ->get();

        return view(
            'admin.academic-years.index',
            compact('academicYears')
        );
    }

    public function create()
    {
        return view(
            'admin.academic-years.create'
        );
    }

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
                    'ganjil',
                    'genap',
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
            ],

        ], [

            'name.regex' =>
                'Format tahun ajaran harus seperti 2026/2027.',

            'end_date.after_or_equal' =>
                'Tanggal selesai tidak boleh sebelum tanggal mulai.',

        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['registration_open'] =
            $request->boolean('registration_open');

        $validated['course_selection_open'] =
            $request->boolean('course_selection_open');

        /*
        |--------------------------------------------------------------------------
        | JIKA DIJADIKAN AKTIF
        |--------------------------------------------------------------------------
        */

        if ($validated['is_active']) {

            AcademicYear::query()
                ->update([
                    'is_active' => false,
                ]);
        }

        AcademicYear::create($validated);

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                'Tahun ajaran berhasil ditambahkan.'
            );
    }

    public function show(AcademicYear $academicYear)
    {
        return redirect()
            ->route(
                'admin.academic-years.edit',
                $academicYear
            );
    }

    public function edit(AcademicYear $academicYear)
    {
        return view(
            'admin.academic-years.edit',
            compact('academicYear')
        );
    }

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
                    'ganjil',
                    'genap',
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
            ],

        ], [

            'name.regex' =>
                'Format tahun ajaran harus seperti 2026/2027.',

            'end_date.after_or_equal' =>
                'Tanggal selesai tidak boleh sebelum tanggal mulai.',

        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['registration_open'] =
            $request->boolean('registration_open');

        $validated['course_selection_open'] =
            $request->boolean('course_selection_open');

        /*
        |--------------------------------------------------------------------------
        | AKTIFKAN YANG INI
        |--------------------------------------------------------------------------
        */

        if ($validated['is_active']) {

            AcademicYear::query()
                ->where('id', '!=', $academicYear->id)
                ->update([
                    'is_active' => false,
                ]);
        }

        $academicYear->update($validated);

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                'Tahun ajaran berhasil diperbarui.'
            );
    }

    public function destroy(
        AcademicYear $academicYear
    ) {
        if ($academicYear->is_active) {

            return back()->with(
                'error',
                'Tahun ajaran yang sedang aktif tidak dapat dihapus.'
            );
        }

        $academicYear->delete();

        return redirect()
            ->route('admin.academic-years.index')
            ->with(
                'success',
                'Tahun ajaran berhasil dihapus.'
            );
    }
}