<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchoolClassController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $classes = SchoolClass::with([
            'academicYear',
            'homeroomTeacher',
        ])
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
    */

    public function create()
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
            'admin.classes.create',
            compact(
                'academicYears',
                'teachers'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
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
                'max:20',
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


            'is_active' => [
                'nullable',
                'boolean',
            ],

            'description' => [
                'nullable',
                'string',
            ],

        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        SchoolClass::create($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with(
                'success',
                'Kelas berhasil ditambahkan.'
            );

        /*
        |--------------------------------------------------------------------------
        | CEGAH KELAS DUPLIKAT
        |--------------------------------------------------------------------------
        */

        $exists = SchoolClass::query()
            ->where(
                'academic_year_id',
                $validated['academic_year_id']
            )
            ->where(
                'name',
                $validated['name']
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'name' =>
                    'Kelas tersebut sudah ada pada tahun ajaran yang dipilih.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CEGAH GURU MENJADI WALI KELAS GANDA
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['homeroom_teacher_id'])) {

            $teacherAlreadyHomeroom =
                SchoolClass::query()
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
    */

    public function show(SchoolClass $schoolClass)
    {
        return redirect()
            ->route(
                'admin.classes.edit',
                $schoolClass
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(\App\Models\SchoolClass $class)
    {
        $academicYears = \App\Models\AcademicYear::query()
            ->orderBy('name', 'desc')
            ->orderBy('semester')
            ->get();

        $teachers = \App\Models\Teacher::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.classes.edit', [
            'schoolClass' => $class,
            'academicYears' => $academicYears,
            'teachers' => $teachers,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
public function update(
    Request $request,
    \App\Models\SchoolClass $class
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

    $validated['is_active'] = $request->boolean('is_active');

    /*
    |--------------------------------------------------------------------------
    | CEGAH DUPLIKAT KELAS
    |--------------------------------------------------------------------------
    */

    $exists = \App\Models\SchoolClass::query()
        ->where('academic_year_id', $validated['academic_year_id'])
        ->where('name', $validated['name'])
        ->where('id', '!=', $class->id)
        ->exists();

    if ($exists) {
        return back()
            ->withInput()
            ->withErrors([
                'name' => 'Kelas tersebut sudah ada pada tahun ajaran yang dipilih.',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CEGAH WALI KELAS GANDA
    |--------------------------------------------------------------------------
    */

    if (!empty($validated['homeroom_teacher_id'])) {

        $teacherAlreadyHomeroom = \App\Models\SchoolClass::query()
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
    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        SchoolClass $schoolClass
    ) {
        $schoolClass->delete();

        return redirect()
            ->route('admin.classes.index')
            ->with(
                'success',
                'Kelas berhasil dihapus.'
            );
    }
}
