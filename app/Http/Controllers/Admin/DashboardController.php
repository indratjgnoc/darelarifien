<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\News;
use App\Models\Program;
use App\Models\Registration;
use App\Models\Teacher;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $statistics = [
            'registrations' => Registration::count(),

            'pending' => Registration::where(
                'status',
                'pending'
            )->count(),

            'processed' => Registration::where(
                'status',
                'processed'
            )->count(),

            'accepted' => Registration::where(
                'status',
                'accepted'
            )->count(),

            'rejected' => Registration::where(
                'status',
                'rejected'
            )->count(),

            'news' => News::count(),

            'teachers' => Teacher::count(),

            'programs' => Program::count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | PENDAFTAR TERBARU
        |--------------------------------------------------------------------------
        */

        $latestRegistrations = Registration::latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BERITA TERBARU
        |--------------------------------------------------------------------------
        */

        $latestNews = News::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PENGUMUMAN
        |--------------------------------------------------------------------------
        */

        $latestAnnouncements = Announcement::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | EVENT TERDEKAT
        |--------------------------------------------------------------------------
        */

        $upcomingEvents = Event::where(
            'is_published',
            true
        )
            ->where(
                'start_at',
                '>=',
                now()
            )
            ->orderBy('start_at')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'statistics',
                'latestRegistrations',
                'latestNews',
                'latestAnnouncements',
                'upcomingEvents'
            )
        );
    }
}