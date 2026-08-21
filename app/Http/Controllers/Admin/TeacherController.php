<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar guru/ustadz/ustadzah.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('sort_order')
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
     * Menyimpan guru baru.
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
                'required',
                'string',
                'max:255',
            ],

            'education' => [
                'nullable',
                'string',
                'max:255',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'bio' => [
                'nullable',
                'string',
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
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['name']
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {
            $validated['photo'] =
                $request->file('photo')
                    ->store('teachers', 'public');
        }

        Teacher::create($validated);

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Data ustadz/ustadzah berhasil ditambahkan.'
            );
    }

    /**
     * Form edit guru.
     */
    public function edit(Teacher $teacher)
    {
        return view(
            'admin.teachers.edit',
            compact('teacher')
        );
    }

    /**
     * Memperbarui data guru.
     */
    public function update(
        Request $request,
        Teacher $teacher
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'required',
                'string',
                'max:255',
            ],

            'education' => [
                'nullable',
                'string',
                'max:255',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'bio' => [
                'nullable',
                'string',
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
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Slug
        |--------------------------------------------------------------------------
        */

        if ($teacher->name !== $validated['name']) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['name'],
                    $teacher->id
                );
        }

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Ganti Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $teacher->photo &&
                Storage::disk('public')
                    ->exists($teacher->photo)
            ) {
                Storage::disk('public')
                    ->delete($teacher->photo);
            }

            $validated['photo'] =
                $request->file('photo')
                    ->store('teachers', 'public');
        }

        $teacher->update($validated);

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Data ustadz/ustadzah berhasil diperbarui.'
            );
    }

    /**
     * Menghapus guru.
     */
    public function destroy(Teacher $teacher)
    {
        if (
            $teacher->photo &&
            Storage::disk('public')
                ->exists($teacher->photo)
        ) {
            Storage::disk('public')
                ->delete($teacher->photo);
        }

        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with(
                'success',
                'Data ustadz/ustadzah berhasil dihapus.'
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

        $originalSlug = $slug;

        $counter = 1;

        while (
            Teacher::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where(
                            'id',
                            '!=',
                            $ignoreId
                        )
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }
}