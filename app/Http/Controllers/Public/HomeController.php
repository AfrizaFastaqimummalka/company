<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::featured()->limit(3)->get();

        $stats = [
            ['value' => '50',  'suffix' => '+',  'label' => 'Judul Buku'],
            ['value' => '10',  'suffix' => 'K+', 'label' => 'Pembaca Aktif'],
            ['value' => '8',   'suffix' => '+',  'label' => 'Tahun Pengalaman'],
            ['value' => '15',  'suffix' => '+',  'label' => 'Topik Pemrograman'],
        ];

        $clients = [
            'PHP', 'Laravel', 'JavaScript', 'Python', 'MySQL',
            'Flutter', 'React', 'Node.js', 'Vue.js', 'CodeIgniter',
        ];

        return view('public.home', compact('featuredServices', 'stats', 'clients'));
    }
}
