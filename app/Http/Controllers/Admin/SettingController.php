<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view(
            'admin.settings.index',
            compact('settings')
        );
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

        'logo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

    ]);


    /*
    |--------------------------------------------------------------------------
    | SIMPAN SETTING TEKS
    |--------------------------------------------------------------------------
    */

    foreach ($validated as $key => $value) {

        // File logo diproses terpisah
        if ($key === 'logo') {
            continue;
        }

        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value ?? '']
        );

    }


    /*
    |--------------------------------------------------------------------------
    | STATUS PENDAFTARAN
    |--------------------------------------------------------------------------
    */

    Setting::updateOrCreate(
        ['key' => 'registration_open'],
        [
            'value' =>
                $request->has('registration_open')
                    ? '1'
                    : '0'
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | UPLOAD LOGO
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('logo')) {

        $setting = Setting::where(
            'key',
            'logo'
        )->first();

        // Hapus logo lama
        if (
            $setting &&
            !empty($setting->value) &&
            Storage::disk('public')->exists($setting->value)
        ) {

            Storage::disk('public')->delete(
                $setting->value
            );
        }


        // Upload logo baru
        $logoPath = $request
            ->file('logo')
            ->store(
                'settings',
                'public'
            );


        Setting::updateOrCreate(
            ['key' => 'logo'],
            ['value' => $logoPath]
        );
    }


    return back()->with(
        'success',
        'Pengaturan berhasil diperbarui.'
    );
}
}