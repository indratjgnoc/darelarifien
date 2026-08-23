<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Daftar pesan masuk.
     */
    public function index(): View
    {
        $contacts = Contact::query()
            ->latest()
            ->paginate(10);

        return view(
            'admin.contacts.index',
            compact('contacts')
        );
    }


    /**
     * Detail pesan.
     */
    public function show(Contact $contact): View
    {
        if (!$contact->is_read) {
            $contact->update([
                'is_read' => true,
            ]);
        }

        return view(
            'admin.contacts.show',
            compact('contact')
        );
    }


    /**
     * Hapus pesan.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with(
                'success',
                'Pesan berhasil dihapus.'
            );
    }
}