<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar guru/ustadz/ustadzah.
     */
    public function index()
    {
        $teachers = Teacher::with('user')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view(
            'admin.teachers.index',
            compact('teachers')
        );
    }

    /**
     * Form tambah guru.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Menyimpan guru sekaligus membuat akun login.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'education' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bio' => [
                'nullable',
                'string',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        DB::transaction(function () use ($request, $validated) {

            /*
            |--------------------------------------------------------------------------
            | BUAT AKUN USER
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'guru',
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPLOAD FOTO
            |--------------------------------------------------------------------------
            */

            $photoPath = null;

            if ($request->hasFile('photo')) {
                $photoPath = $request
                    ->file('photo')
                    ->store('teachers', 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | BUAT DATA TEACHER
            |--------------------------------------------------------------------------
            */

            Teacher::create([
                'user_id' => $user->id,

                'name' => $validated['name'],

                'slug' => $this->generateUniqueSlug(
                    $validated['name']
                ),

                'position' =>
                $validated['position'] ?? null,

                'education' =>
                $validated['education'] ?? null,

                'photo' => $photoPath,

                'bio' =>
                $validated['bio'] ?? null,

                'is_active' =>
                $request->boolean('is_active'),

                'sort_order' =>
                $validated['sort_order'] ?? 0,
            ]);
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Guru dan akun login berhasil dibuat.'
            );
    }

    /**
     * Form edit guru.
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('user');

        return view(
            'admin.teachers.edit',
            compact('teacher')
        );
    }

    /**
     * Memperbarui data guru dan akun login.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'education' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bio' => [
                'nullable',
                'string',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . ($teacher->user_id ?? 'NULL'),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ]);


        DB::transaction(function () use (
            $request,
            $validated,
            $teacher
        ) {

            /*
        |--------------------------------------------------------------------------
        | AKUN USER
        |--------------------------------------------------------------------------
        */

            if ($teacher->user_id) {

                $user = User::findOrFail(
                    $teacher->user_id
                );

                $user->name =
                    $validated['name'];

                $user->email =
                    $validated['email'];

                $user->role = 'guru';

                if (
                    !empty($validated['password'])
                ) {

                    $user->password =
                        $validated['password'];
                }

                $user->save();
            } else {

                /*
            |--------------------------------------------------------------
            | JIKA GURU BELUM MEMILIKI AKUN
            |--------------------------------------------------------------
            */

                $user = User::create([

                    'name' =>
                    $validated['name'],

                    'email' =>
                    $validated['email'],

                    'password' =>
                    $validated['password'],

                    'role' =>
                    'guru',

                ]);

                $teacher->user_id =
                    $user->id;
            }


            /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('photo')) {

                $teacher->photo =
                    $request
                    ->file('photo')
                    ->store(
                        'teachers',
                        'public'
                    );
            }


            /*
        |--------------------------------------------------------------------------
        | DATA GURU
        |--------------------------------------------------------------------------
        */

            $teacher->name =
                $validated['name'];

            $teacher->slug =
                \Illuminate\Support\Str::slug(
                    $validated['name']
                );

            $teacher->position =
                $validated['position'] ?? null;

            $teacher->education =
                $validated['education'] ?? null;

            $teacher->bio =
                $validated['bio'] ?? null;

            $teacher->is_active =
                $request->boolean('is_active');

            $teacher->sort_order =
                $validated['sort_order'] ?? 0;

            $teacher->save();
        });


        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Data guru dan akun login berhasil diperbarui.'
            );
    }

    /**
     * Menghapus guru sekaligus akun login.
     */
    public function destroy(Teacher $teacher)
    {
        DB::transaction(function () use ($teacher) {

            /*
            |--------------------------------------------------------------------------
            | HAPUS FOTO
            |--------------------------------------------------------------------------
            */

            if (
                $teacher->photo &&
                Storage::disk('public')
                ->exists($teacher->photo)
            ) {
                Storage::disk('public')
                    ->delete($teacher->photo);
            }

            //HAPUS USER
            $user = $teacher->user;

            //HAPUS TEACHER
            $teacher->delete();

            //HAPUS AKUN
            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Data guru dan akun login berhasil dihapus.'
            );
    }

    /**
     * Membuat slug unik.
     */
    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($name);

        //Jika nama kosong setelah slugging.

        if ($slug === '') {
            $slug = 'teacher';
        }

        $originalSlug = $slug;
        $counter = 1;

        while (
            Teacher::where('slug', $slug)
            ->when(
                $ignoreId !== null,
                function ($query) use ($ignoreId) {
                    $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    );
                }
            )
            ->exists()
        ) {
            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }

        return $slug;
    }
}
