<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('start_at')
            ->paginate(10);

        return view(
            'admin.events.index',
            compact('events')
        );
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'start_at' => [
                'required',
                'date',
            ],

            'end_at' => [
                'nullable',
                'date',
                'after_or_equal:start_at',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
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

        if ($request->hasFile('image')) {
            $validated['image'] =
                $request->file('image')
                    ->store('events', 'public');
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Agenda berhasil ditambahkan.'
            );
    }

    public function edit(Event $event)
    {
        return view(
            'admin.events.edit',
            compact('event')
        );
    }

    public function update(
        Request $request,
        Event $event
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'start_at' => [
                'required',
                'date',
            ],

            'end_at' => [
                'nullable',
                'date',
                'after_or_equal:start_at',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);

        if ($event->title !== $validated['title']) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $event->id
                );
        }

        $validated['is_published'] =
            $request->boolean('is_published');

        if ($request->hasFile('image')) {

            if ($event->image) {
                Storage::disk('public')
                    ->delete($event->image);
            }

            $validated['image'] =
                $request->file('image')
                    ->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Agenda berhasil diperbarui.'
            );
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')
                ->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with(
                'success',
                'Agenda berhasil dihapus.'
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
            Event::where('slug', $slug)
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