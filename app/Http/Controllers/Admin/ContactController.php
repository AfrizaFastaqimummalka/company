<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('email', 'ilike', '%' . $request->search . '%')
                  ->orWhere('subject', 'ilike', '%' . $request->search . '%');
            });
        }

        $contacts = $query->paginate(20)->withQueryString();

        return view('pages.admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        if ($contact->status === 'unread') {
            $contact->markAsRead();
        }

        return view('pages.admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status'      => ['required', 'in:unread,read,replied'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $contact->update($validated);

        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
