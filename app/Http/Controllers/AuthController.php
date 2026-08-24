<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI LOGIN
        |--------------------------------------------------------------------------
        */

        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials)) {

            return back()
                ->withErrors([
                    'email' => 'Email atau password tidak sesuai.',
                ])
                ->onlyInput('email');
        }


        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        // ADMIN
        if ($user->role === 'admin') {

            return redirect()
                ->route('admin.dashboard');
        }


        // GURU
        if ($user->role === 'guru') {

            return redirect()
                ->route('guru.dashboard');
        }


        // OPERATOR
        if ($user->role === 'operator') {

            return redirect()
                ->route('operator.dashboard');
        }


        // SANTRI
        if ($user->role === 'santri') {

            return redirect()
                ->route('santri.dashboard');
        }


        // ORANG TUA
        if ($user->role === 'orang_tua') {

            return redirect()
                ->route('orangtua.dashboard');
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE BELUM MEMILIKI DASHBOARD
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role akun belum memiliki akses sistem.',
            ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}