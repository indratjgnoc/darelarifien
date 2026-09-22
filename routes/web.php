<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicRegistrationController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherClassSubjectController;

use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Guru\GuruClassController;
use App\Http\Controllers\Guru\GuruProfileController;
use App\Http\Controllers\Guru\GuruScheduleController;
use App\Http\Controllers\Guru\GuruGradeController;

use App\Http\Controllers\Santri\SantriDashboardController;
use App\Http\Controllers\Santri\SantriSubjectController;
use App\Http\Controllers\Santri\SantriScheduleController;

/*
|--------------------
| WEBSITE PUBLIC
|--------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

//Profil
Route::get('/profil', [PublicController::class, 'profile'])
    ->name('profile');

//PENGASUH
Route::get('/pengasuh', [PublicController::class, 'teachers'])
    ->name('teachers.index');

//Program
Route::get('/program', [PublicController::class, 'programs'])
    ->name('programs.index');

Route::get('/program/{program:slug}', [PublicController::class, 'program'])
    ->name('program.show');

//Berita
Route::get('/berita', [PublicController::class, 'news'])
    ->name('news.index');

Route::get('/berita/{news:slug}', [PublicController::class, 'newsShow'])
    ->name('news.show');

//Agenda
Route::get('/agenda', [PublicController::class, 'events'])
    ->name('events.index');

Route::get('/agenda/{event:slug}', [PublicController::class, 'eventShow'])
    ->name('events.show');

//Galeri
Route::get('/galeri', [PublicController::class, 'gallery'])
    ->name('gallery.index');

//Kontak
Route::get('/kontak', [PublicController::class, 'contact'])
    ->name('contact');

Route::post('/kontak', [PublicController::class, 'storeContact'])
    ->name('contact.store');

//Pendaftaran
Route::get(
    '/pendaftaran',
    [PublicRegistrationController::class, 'create']
)->name('registration.create');

Route::post(
    '/pendaftaran',
    [PublicRegistrationController::class, 'store']
)->name('registration.store');

Route::get(
    '/pendaftaran/sukses/{registrationNumber}',
    [PublicRegistrationController::class, 'success']
)->name('registration.success');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'login']
    )->name('login.process');
});

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)
    ->middleware('auth')
    ->name('logout');

// ==============================
// ROLE GURU
// ==============================
Route::prefix('guru')
    ->name('guru.')
    ->middleware(['auth', 'role:guru'])
    ->group(function () {

        Route::get(
            '/dashboard',
            [GuruDashboardController::class, 'index']
        )->name('dashboard');

        Route::get(
            '/kelas',
            ['App\\Http\\Controllers\\Guru\\GuruClassController', 'index']
        )->name('class.index');

        Route::get('/kelas/{id}', [
            GuruClassController::class,
            'show'
        ])->name('classes.show');

        Route::get(
            '/nilai',
            [GuruGradeController::class, 'assignments']
        )->name('grades.assignments');
        
        Route::get(
            '/nilai/{assignmentId}',
            [GuruGradeController::class, 'index']
        )->name('grades.index');

        Route::post(
            '/nilai/{assignmentId}',
            [GuruGradeController::class, 'store']
        )->name('grades.store');

        Route::get(
            '/profil',
            [GuruProfileController::class, 'index']
        )->name('profile');

        Route::get(
            '/jadwal',
            [GuruScheduleController::class, 'index']
        )->name('schedules.index');
    });


// ==============================
// ROLE SANTRI
// ==============================

Route::prefix('santri')
    ->name('santri.')
    ->middleware(['auth', 'role:santri'])
    ->group(function () {

        Route::get(
            '/dashboard',
            [SantriDashboardController::class, 'index']
        )->name('dashboard');

        Route::get(
            '/profil',
            [SantriDashboardController::class, 'profile']
        )->name('profile');

        Route::get('/mata-pelajaran', [SantriSubjectController::class, 'index'])
            ->name('subjects.index');

        Route::get(
            '/jadwal',
            [SantriScheduleController::class, 'index']
        )->name('schedules.index');
    });

/*
|----------------------------
| ROLE ADMIN
|----------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        //Dashboard
        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');

        //Settings
        Route::get(
            '/settings',
            [SettingController::class, 'index']
        )->name('settings');

        Route::put(
            '/settings',
            [SettingController::class, 'update']
        )->name('settings.update');


        //Programs
        Route::resource('programs', ProgramController::class)
            ->except([
                'show',
            ]);

        //Teachers
        Route::resource('teachers', TeacherController::class)
            ->except([
                'show',
            ]);

        //News
        Route::resource('news', NewsController::class)
            ->except([
                'show',
            ]);

        //Announcements
        Route::resource('announcements', AnnouncementController::class)
            ->except([
                'show',
            ]);

        //Schedule
        Route::resource('schedules', ScheduleController::class)
            ->except([
                'show',
            ]);

        //Events
        Route::resource('events', EventController::class)
            ->except([
                'show',
            ]);

        //Galleries
        Route::resource('galleries', GalleryController::class)
            ->except([
                'show',
            ]);

        //Contacts
        Route::resource(
            'contacts',
            ContactController::class
        )->only([
            'index',
            'show',
            'destroy',
        ]);

        Route::resource('students', StudentController::class);

        Route::post(
            'students/{student}/create-account',
            [StudentController::class, 'createAccount']
        )->name('students.create-account');


        //Registrations
        Route::get(
            '/registrations/{registration}/document',
            [RegistrationController::class, 'document']
        )->name('registrations.document');

        // Classes
        Route::resource(
            'classes',
            SchoolClassController::class
        )->except([
            'show',
        ]);


        Route::resource(
            'teacher-class-subjects',
            TeacherClassSubjectController::class
        )->except(['show']);

        //Academic Years
        Route::resource(
            'academic-years',
            AcademicYearController::class
        )->except([
            'show'
        ]);

        Route::post(
            'academic-years/{academicYear}/activate',
            [AcademicYearController::class, 'activate']
        )->name('academic-years.activate');

        Route::post(
            'academic-years/{academicYear}/toggle-course-selection',
            [AcademicYearController::class, 'toggleCourseSelection']
        )->name('academic-years.toggle-course-selection');

        Route::patch(
            'academic-years/{academicYear}/activate',
            [AcademicYearController::class, 'activate']
        )->name('academic-years.activate');

        Route::resource(
            'registrations',
            RegistrationController::class
        )->only([
            'index',
            'show',
            'update',
            'destroy',
        ]);

        Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
    });
