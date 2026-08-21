<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view(
            'admin.galleries.index',
            compact('galleries')
        );
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],

            'category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'description' => [
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

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $request->integer('sort_order', 0);

        if ($request->hasFile('image')) {
            $validated['image'] =
                $request->file('image')
                    ->store('galleries', 'public');
        }

        Gallery::create($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with(
                'success',
                'Foto galeri berhasil ditambahkan.'
            );
    }

    public function edit(Gallery $gallery)
    {
        return view(
            'admin.galleries.edit',
            compact('gallery')
        );
    }

    public function update(
        Request $request,
        Gallery $gallery
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],

            'category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'description' => [
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

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $request->integer('sort_order', 0);

        if ($request->hasFile('image')) {

            if ($gallery->image) {
                Storage::disk('public')
                    ->delete($gallery->image);
            }

            $validated['image'] =
                $request->file('image')
                    ->store('galleries', 'public');
        }

        $gallery->update($validated);

        return redirect()
            ->route('admin.galleries.index')
            ->with(
                'success',
                'Foto galeri berhasil diperbarui.'
            );
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')
                ->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with(
                'success',
                'Foto galeri berhasil dihapus.'
            );
    }
}