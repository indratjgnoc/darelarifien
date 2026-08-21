<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'description' => [
                'required',
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
            $validated['title']
        );

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] =
                $request->file('image')
                    ->store('programs', 'public');
        }

        Program::create($validated);

        return redirect()
            ->route('admin.programs.index')
            ->with(
                'success',
                'Program pendidikan berhasil ditambahkan.'
            );
    }

    public function edit(Program $program)
    {
        return view(
            'admin.programs.edit',
            compact('program')
        );
    }

    public function update(
        Request $request,
        Program $program
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'description' => [
                'required',
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

        if ($program->title !== $validated['title']) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $program->id
                );
        }

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {

            if (
                $program->image &&
                Storage::disk('public')
                    ->exists($program->image)
            ) {
                Storage::disk('public')
                    ->delete($program->image);
            }

            $validated['image'] =
                $request->file('image')
                    ->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()
            ->route('admin.programs.index')
            ->with(
                'success',
                'Program pendidikan berhasil diperbarui.'
            );
    }

    public function destroy(Program $program)
    {
        if (
            $program->image &&
            Storage::disk('public')
                ->exists($program->image)
        ) {
            Storage::disk('public')
                ->delete($program->image);
        }

        $program->delete();

        return redirect()
            ->route('admin.programs.index')
            ->with(
                'success',
                'Program pendidikan berhasil dihapus.'
            );
    }

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($title);

        $originalSlug = $slug;

        $counter = 1;

        while (
            Program::where('slug', $slug)
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