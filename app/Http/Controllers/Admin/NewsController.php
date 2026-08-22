<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Daftar berita.
     */
    public function index(Request $request): View
    {
        $query = News::query()
            ->with('user');

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                );

                $q->orWhere(
                    'category',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            if ($request->status === 'published') {

                $query->where(
                    'is_published',
                    true
                );

            } elseif ($request->status === 'draft') {

                $query->where(
                    'is_published',
                    false
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $news = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $statistics = [

            'total' =>
                News::count(),

            'published' =>
                News::where(
                    'is_published',
                    true
                )->count(),

            'draft' =>
                News::where(
                    'is_published',
                    false
                )->count(),

        ];


        return view(
            'admin.news.index',
            compact(
                'news',
                'statistics'
            )
        );
    }


    /**
     * Form tambah berita.
     */
    public function create(): View
    {
        return view(
            'admin.news.create'
        );
    }


    /**
     * Simpan berita.
     */
    public function store(
        Request $request
    ): RedirectResponse {

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
                'required',
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
                'max:5120',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $this->generateUniqueSlug(
            $validated['title']
        );


        /*
        |--------------------------------------------------------------------------
        | THUMBNAIL
        |--------------------------------------------------------------------------
        */

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail =
                $request
                    ->file('thumbnail')
                    ->store(
                        'news',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | PUBLISH
        |--------------------------------------------------------------------------
        */

        $isPublished =
            $request->boolean(
                'is_published'
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        News::create([

            'title' =>
                $validated['title'],

            'slug' =>
                $slug,

            'category' =>
                $validated['category'],

            'thumbnail' =>
                $thumbnail,

            'excerpt' =>
                $validated['excerpt'],

            'content' =>
                $validated['content'],

            'is_published' =>
                $isPublished,

            'published_at' =>
                $isPublished
                    ? now()
                    : null,

            'user_id' =>
                Auth::id(),

        ]);


        return redirect()
            ->route(
                'admin.news.index'
            )
            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );
    }


    /**
     * Form edit.
     */
    public function edit(
        News $news
    ): View {

        return view(
            'admin.news.edit',
            compact('news')
        );
    }


    /**
     * Update berita.
     */
    public function update(
        Request $request,
        News $news
    ): RedirectResponse {

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
                'required',
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
                'max:5120',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        if (
            $news->title !==
            $validated['title']
        ) {

            $slug =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $news->id
                );

        } else {

            $slug = $news->slug;
        }


        /*
        |--------------------------------------------------------------------------
        | THUMBNAIL
        |--------------------------------------------------------------------------
        */

        $thumbnail =
            $news->thumbnail;

        if ($request->hasFile('thumbnail')) {

            if (
                $thumbnail &&
                Storage::disk('public')
                    ->exists($thumbnail)
            ) {
                Storage::disk('public')
                    ->delete($thumbnail);
            }

            $thumbnail =
                $request
                    ->file('thumbnail')
                    ->store(
                        'news',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | PUBLISH
        |--------------------------------------------------------------------------
        */

        $isPublished =
            $request->boolean(
                'is_published'
            );


        $publishedAt =
            $news->published_at;


        if (
            $isPublished &&
            !$publishedAt
        ) {
            $publishedAt = now();
        }


        if (!$isPublished) {
            $publishedAt = null;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $news->update([

            'title' =>
                $validated['title'],

            'slug' =>
                $slug,

            'category' =>
                $validated['category'],

            'thumbnail' =>
                $thumbnail,

            'excerpt' =>
                $validated['excerpt'],

            'content' =>
                $validated['content'],

            'is_published' =>
                $isPublished,

            'published_at' =>
                $publishedAt,

        ]);


        return redirect()
            ->route(
                'admin.news.index'
            )
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }


    /**
     * Hapus berita.
     */
    public function destroy(
        News $news
    ): RedirectResponse {

        if (
            $news->thumbnail &&
            Storage::disk('public')
                ->exists($news->thumbnail)
        ) {

            Storage::disk('public')
                ->delete(
                    $news->thumbnail
                );
        }


        $news->delete();


        return redirect()
            ->route(
                'admin.news.index'
            )
            ->with(
                'success',
                'Berita berhasil dihapus.'
            );
    }


    /**
     * Generate slug unik.
     */
    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $baseSlug =
            Str::slug($title);

        $slug = $baseSlug;

        $counter = 1;


        while (
            News::where(
                'slug',
                $slug
            )
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

            $slug =
                $baseSlug .
                '-' .
                $counter;

            $counter++;
        }


        return $slug;
    }
}