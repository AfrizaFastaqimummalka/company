<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services'         => Service::count(),
            'gallery'          => Gallery::count(),
            'contacts'         => Contact::count(),
            'unread_contacts'  => Contact::unread()->count(),
        ];

        $recentContacts = Contact::latest()->limit(5)->get();

        return view('pages.admin.dashboard', compact('stats', 'recentContacts'));
    }
}
