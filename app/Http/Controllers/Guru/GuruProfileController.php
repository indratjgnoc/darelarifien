<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GuruProfileController extends Controller
{
    public function index(): View
    {
        $teacher = Auth::user()->teacher;

        return view('guru.profile', compact('teacher'));
    }
}