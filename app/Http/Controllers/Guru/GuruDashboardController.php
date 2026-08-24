<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class GuruDashboardController extends Controller
{
    public function index(): View
    {
        return view('guru.dashboard');
    }
}