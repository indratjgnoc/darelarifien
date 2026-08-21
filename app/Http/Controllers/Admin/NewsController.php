<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'excerpt' => [
                'nullable',
                'string',
                'max:500',
            ],

            'content' => [
                'required',
                'string',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );

        $validated['user_id'] = Auth::id();

        $validated['is_published'] =
            $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] =
                $request->file('thumbnail')
                    ->store('news', 'public');
        }

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(
        Request $request,
        News $news
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'excerpt' => [
                'nullable',
                'string',
                'max:500',
            ],

            'content' => [
                'required',
                'string',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);

        if ($news->title !== $validated['title']) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $news->id
                );
        }

        $validated['is_published'] =
            $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {

            if (
                $news->thumbnail &&
                Storage::disk('public')
                    ->exists($news->thumbnail)
            ) {
                Storage::disk('public')
                    ->delete($news->thumbnail);
            }

            $validated['thumbnail'] =
                $request->file('thumbnail')
                    ->store('news', 'public');
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }

    public function destroy(News $news)
    {
        if (
            $news->thumbnail &&
            Storage::disk('public')
                ->exists($news->thumbnail)
        ) {
            Storage::disk('public')
                ->delete($news->thumbnail);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with(
                'success',
                'Berita berhasil dihapus.'
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
            News::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}