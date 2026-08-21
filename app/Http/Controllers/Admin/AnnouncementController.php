<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()
            ->paginate(10);

        return view(
            'admin.announcements.index',
            compact('announcements')
        );
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );

        $validated['is_published'] =
            $request->boolean('is_published');

        Announcement::create($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with(
                'success',
                'Pengumuman berhasil ditambahkan.'
            );
    }

    public function edit(Announcement $announcement)
    {
        return view(
            'admin.announcements.edit',
            compact('announcement')
        );
    }

    public function update(
        Request $request,
        Announcement $announcement
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);

        if ($announcement->title !== $validated['title']) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $announcement->id
                );
        }

        $validated['is_published'] =
            $request->boolean('is_published');

        $announcement->update($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with(
                'success',
                'Pengumuman berhasil diperbarui.'
            );
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with(
                'success',
                'Pengumuman berhasil dihapus.'
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
            Announcement::where('slug', $slug)
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