<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicRegistrationController extends Controller
{
    public function create(): View
    {
        $programs = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view(
            'public.registrations.create',
            compact('programs')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'student_name' => [
                'required',
                'string',
                'max:255',
            ],

            'gender' => [
                'required',
                'in:L,P',
            ],

            'birth_date' => [
                'required',
                'date',
            ],

            'birth_place' => [
                'required',
                'string',
                'max:100',
            ],

            'address' => [
                'required',
                'string',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'parent_name' => [
                'required',
                'string',
                'max:255',
            ],

            'parent_phone' => [
                'required',
                'string',
                'max:30',
            ],

            'school_origin' => [
                'required',
                'string',
                'max:255',
            ],

            'program' => [
                'required',
                'string',
                'max:255',
            ],

            'document' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | NOMOR PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        $registrationNumber =
            'DA-' .
            now()->format('Ymd') .
            '-' .
            strtoupper(
                Str::random(5)
            );


        /*
        |--------------------------------------------------------------------------
        | UPLOAD DOKUMEN
        |--------------------------------------------------------------------------
        */

        $documentPath = null;

        if ($request->hasFile('document')) {

            $documentPath =
                $request->file('document')
                    ->store(
                        'registrations',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $registration = Registration::create([

            'registration_number' =>
                $registrationNumber,

            'student_name' =>
                $validated['student_name'],

            'gender' =>
                $validated['gender'],

            'birth_date' =>
                $validated['birth_date'],

            'birth_place' =>
                $validated['birth_place'],

            'address' =>
                $validated['address'],

            'phone' =>
                $validated['phone'],

            'email' =>
                $validated['email'] ?? null,

            'parent_name' =>
                $validated['parent_name'],

            'parent_phone' =>
                $validated['parent_phone'],

            'school_origin' =>
                $validated['school_origin'],

            'program' =>
                $validated['program'],

            'document' =>
                $documentPath,

            'status' =>
                'pending',

        ]);


        return redirect()
            ->route(
                'registration.success',
                $registration->registration_number
            );
    }


    public function success(
        string $registrationNumber
    ): View {

        $registration =
            Registration::where(
                'registration_number',
                $registrationNumber
            )->firstOrFail();

        return view(
            'public.registrations.success',
            compact('registration')
        );
    }
}