<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;

/*
Route::get('/', function () {
    return view('frontend.home');
})->name('home');*/

// ==============================
// WEBSITE PUBLIC
// ==============================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/profil', [PublicController::class, 'profile'])
    ->name('profile');

Route::get('/program/{program:slug}', [PublicController::class, 'program'])
    ->name('program.show');

Route::get('/berita', [PublicController::class, 'news'])
    ->name('news.index');

Route::get('/berita/{news:slug}', [PublicController::class, 'newsShow'])
    ->name('news.show');

Route::get('/agenda', [PublicController::class, 'events'])
    ->name('events.index');

Route::get('/agenda/{event:slug}', [PublicController::class, 'eventShow'])
    ->name('events.show');

Route::get('/galeri', [PublicController::class, 'gallery'])
    ->name('gallery.index');
    
    Route::get(
    '/admin/settings',
    [SettingController::class, 'index']
)->name('admin.settings.index');

Route::put(
    '/admin/settings',
    [SettingController::class, 'update']
)->name('admin.settings.update');
    
/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        Route::get('/settings', [SettingController::class, 'index'])
            ->name('settings');

        Route::put('/settings', [SettingController::class, 'update'])
            ->name('settings.update');

Route::resource('events', EventController::class)
    ->except([
        'show',
    ]);
        /*
        |--------------------------------------------------------------------------
        | Programs
        |--------------------------------------------------------------------------
        */

        Route::resource('programs', ProgramController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Teachers
        |--------------------------------------------------------------------------
        */
            Route::resource('teachers', TeacherController::class)
    ->except([
        'show',
    ]);
        /*
        |--------------------------------------------------------------------------
        | Announcements
        |--------------------------------------------------------------------------
        */
    Route::resource('announcements', AnnouncementController::class)
    ->except([
        'show',
    ]);
    /*
        |--------------------------------------------------------------------------
        | Galleries
        |--------------------------------------------------------------------------
        */
    Route::resource('galleries', GalleryController::class)
    ->except([
        'show',
    ]);
        /*
        |--------------------------------------------------------------------------
        | News
        |--------------------------------------------------------------------------
        */

        Route::resource('news', NewsController::class)
            ->except(['show']);
    });