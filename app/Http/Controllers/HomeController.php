<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Program;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $programs = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $news = News::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $announcements = Announcement::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        $events = Event::where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('start_at')
                    ->orWhere('start_at', '>=', now());
            })
            ->orderBy('start_at')
            ->take(4)
            ->get();

        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact(
            'programs',
            /*'teachers',*/
            'news',
            'announcements',
            'events',
            'galleries'
        ));
    }
}