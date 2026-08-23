<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Program;
use App\Models\Teacher;
use App\Models\Setting;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PROGRAM
    |--------------------------------------------------------------------------
    */
    public function programs()
    {
        $programs = Program::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.program.index', compact('programs'));
    }

    /*
    |--------------------------------------------------------------------------
    | GURU
    |--------------------------------------------------------------------------
    */


    public function teachers()
    {
        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.teachers.index', compact('teachers'));
    }


    public function contact()
    {
        $settings = Setting::pluck('value', 'key');

        return view('public.contact', compact('settings'));
    }


    //Kontak
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'subject' => [
                'required',
                'string',
                'max:200',
            ],

            'message' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);

        Contact::create($validated);

        return redirect()
            ->route('contact')
            ->with(
                'success',
                'Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami.'
            );
    }
    /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */

    public function news(): View
    {
        $news = News::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('public.news.index', compact('news'));
    }


    public function newsShow(News $news): View
    {
        abort_unless($news->is_published, 404);

        return view('public.news.show', compact('news'));
    }


    /*
    |--------------------------------------------------------------------------
    | AGENDA
    |--------------------------------------------------------------------------
    */

    public function events(): View
    {
        $events = Event::where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('start_at')
                    ->orWhere('start_at', '>=', now());
            })
            ->orderBy('start_at')
            ->paginate(9);

        return view('public.events.index', compact('events'));
    }


    public function eventShow(Event $event): View
    {
        abort_unless($event->is_published, 404);

        return view('public.events.show', compact('event'));
    }


    /*
    |--------------------------------------------------------------------------
    | GALERI
    |--------------------------------------------------------------------------
    */

    public function gallery(): View
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('public.gallery.index', compact('galleries'));
    }


    /*
    |--------------------------------------------------------------------------
    | PROFIL
    |--------------------------------------------------------------------------
    */

    public function profile(): View
    {
        return view('public.profile');
    }
}
