<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $info = [
            'address' => 'Jl. Sudirman No. 52, Jakarta Selatan 12190',
            'email'   => 'hello@companyprofile.com',
            'phone'   => '+62 21 5555 1234',
            'hours'   => 'Monday – Friday, 08:00 – 17:00 WIB',
            'maps'    => 'https://maps.google.com',
        ];

        return view('public.contact', compact('info'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'phone'   => ['nullable', 'string', 'max:20'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required'    => 'Nama lengkap wajib diisi.',
            'name.min'         => 'Nama minimal 2 karakter.',
            'email.required'   => 'Alamat email wajib diisi.',
            'email.email'      => 'Format alamat email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min'      => 'Pesan minimal 10 karakter.',
        ]);

        Contact::create($validated);

        return redirect()
            ->route('contact')
            ->with('success', 'Terima kasih! Pesan kamu sudah kami terima. Kami akan membalas dalam 1–2 hari kerja.');
    }
}
