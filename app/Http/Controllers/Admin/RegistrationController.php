<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Daftar pendaftaran.
     */
    public function index(Request $request): View
    {
        $query = Registration::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'student_name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'registration_number',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'parent_name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'phone',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $registrations = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $statistics = [

            'total' =>
                Registration::count(),

            'pending' =>
                Registration::where(
                    'status',
                    'pending'
                )->count(),

            'processed' =>
                Registration::where(
                    'status',
                    'processed'
                )->count(),

            'accepted' =>
                Registration::where(
                    'status',
                    'accepted'
                )->count(),

            'rejected' =>
                Registration::where(
                    'status',
                    'rejected'
                )->count(),

        ];


        return view(
            'admin.registrations.index',
            compact(
                'registrations',
                'statistics'
            )
        );
    }


    /**
     * Detail pendaftaran.
     */
    public function show(
        Registration $registration
    ): View {

        return view(
            'admin.registrations.show',
            compact('registration')
        );
    }


    /**
     * Update status.
     */
    public function update(
        Request $request,
        Registration $registration
    ): RedirectResponse {

        $validated = $request->validate([

            'status' => [
                'required',
                'in:pending,processed,accepted,rejected',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

        ]);


        $registration->update([

            'status' =>
                $validated['status'],

            'notes' =>
                $validated['notes'] ?? null,

        ]);


        return back()->with(
            'success',
            'Status pendaftaran berhasil diperbarui.'
        );
    }


    /**
     * Download dokumen.
     */
    public function document(
        Registration $registration
    )
    {
        if (
            !$registration->document ||
            !Storage::disk('public')->exists(
                $registration->document
            )
        ) {
            abort(404);
        }

        return Storage::disk('public')->download(
            $registration->document
        );
    }


    /**
     * Hapus pendaftaran.
     */
    public function destroy(
        Registration $registration
    ): RedirectResponse {

        if (
            $registration->document &&
            Storage::disk('public')->exists(
                $registration->document
            )
        ) {
            Storage::disk('public')->delete(
                $registration->document
            );
        }


        $registration->delete();


        return redirect()
            ->route('admin.registrations.index')
            ->with(
                'success',
                'Data pendaftaran berhasil dihapus.'
            );
    }
}