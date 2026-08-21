<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => [
                'required',
                'string',
                'max:255',
            ],

            'school_short_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'school_description' => [
                'nullable',
                'string',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'facebook' => [
                'nullable',
                'string',
                'max:255',
            ],

            'instagram' => [
                'nullable',
                'string',
                'max:255',
            ],

            'youtube' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vision' => [
                'nullable',
                'string',
            ],

            'mission' => [
                'nullable',
                'string',
            ],
        ]);


        foreach ($validated as $key => $value) {

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );

        }


        return back()->with(
            'success',
            'Pengaturan berhasil diperbarui.'
        );
    }
}