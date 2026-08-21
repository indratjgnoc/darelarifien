<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Program;
use Illuminate\View\View;

class PublicController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PROGRAM
    |--------------------------------------------------------------------------
    */

    public function program(Program $program): View
    {
        abort_unless($program->is_active, 404);

        return view('public.program.show', compact('program'));
    }


    /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */

    public function news(): View
    {
        $news = News::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('public.news.index', compact('news'));
    }


    public function newsShow(News $news): View
    {
        abort_unless($news->is_published, 404);

        return view('public.news.show', compact('news'));
    }


    /*
    |--------------------------------------------------------------------------
    | AGENDA
    |--------------------------------------------------------------------------
    */

    public function events(): View
{
    $events = Event::where('is_published', true)
        ->where(function ($query) {
            $query->whereNull('start_at')
                ->orWhere('start_at', '>=', now());
        })
        ->orderBy('start_at')
        ->paginate(9);

    return view('public.events.index', compact('events'));
}


   public function eventShow(Event $event): View
{
    abort_unless($event->is_published, 404);

    return view('public.events.show', compact('event'));
}


    /*
    |--------------------------------------------------------------------------
    | GALERI
    |--------------------------------------------------------------------------
    */

    public function gallery(): View
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('public.gallery.index', compact('galleries'));
    }


    /*
    |--------------------------------------------------------------------------
    | PROFIL
    |--------------------------------------------------------------------------
    */

    public function profile(): View
    {
        return view('public.profile');
    }
}