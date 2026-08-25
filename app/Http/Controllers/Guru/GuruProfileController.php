<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuruProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $teacher = $user->teacher;

        return view('guru.profile', compact(
            'user',
            'teacher'
        ));
    }
}