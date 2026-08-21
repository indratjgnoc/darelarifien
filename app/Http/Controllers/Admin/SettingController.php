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

            'site_name' => [
                'required',
                'string',
                'max:255',
            ],

            'site_short_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'site_description' => [
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

            'website' => [
                'nullable',
                'url',
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

            'founded_year' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],

        ]);

        foreach ($validated as $key => $value) {

            Setting::setValue(
                $key,
                $value
            );

        }

        return redirect()
            ->route('admin.settings')
            ->with(
                'success',
                'Pengaturan berhasil diperbarui.'
            );
    }
}