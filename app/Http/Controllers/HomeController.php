<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use App\Models\Program;
use App\Models\Teacher;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $programs = Program::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $news = News::query()
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $events = Event::query()
            ->where('is_published', true)
            ->where('start_at', '>=', now())
            ->orderBy('start_at')
            ->limit(3)
            ->get();

        return view('home', compact(
            'programs',
            'teachers',
            'news',
            'events'
        ));
    }
}