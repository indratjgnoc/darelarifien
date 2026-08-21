<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Program;
use App\Models\Registration;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $stats = [
            'programs' => Program::count(),

            'teachers' => Teacher::count(),

            'news' => News::count(),

            'gallery' => Gallery::count(),

            'registrations' => Registration::count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | Berita terbaru
        |--------------------------------------------------------------------------
        */

        $latestNews = News::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Pendaftaran terbaru
        |--------------------------------------------------------------------------
        */

        $latestRegistrations = Registration::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Data untuk grafik pendaftaran
        |--------------------------------------------------------------------------
        */

        $registrationChart = Registration::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $chartLabels = [];

        $chartData = [];

        for ($month = 1; $month <= 12; $month++) {

            $chartLabels[] = now()
                ->setMonth($month)
                ->translatedFormat('M');

            $result = $registrationChart
                ->firstWhere('month', $month);

            $chartData[] = $result
                ? $result->total
                : 0;
        }


        return view('admin.dashboard', compact(
            'stats',
            'latestNews',
            'latestRegistrations',
            'chartLabels',
            'chartData'
        ));
    }
}