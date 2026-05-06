<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $team = [
            [
                'name'     => 'Budi Santoso',
                'role'     => 'Founder & Penulis Utama',
                'bio'      => 'Full-stack developer dengan 15 tahun pengalaman. Penulis lebih dari 20 buku pemrograman berbahasa Indonesia.',
                'linkedin' => '#',
            ],
            [
                'name'     => 'Dewi Rahayu',
                'role'     => 'Editor Teknis',
                'bio'      => 'Mantan software engineer di perusahaan teknologi top Indonesia. Ahli dalam memastikan konten akurat dan mudah dipahami.',
                'linkedin' => '#',
            ],
            [
                'name'     => 'Andi Pratama',
                'role'     => 'Penulis — Web Development',
                'bio'      => 'Spesialis Laravel dan JavaScript dengan pengalaman mengajar di berbagai bootcamp coding ternama.',
                'linkedin' => '#',
            ],
            [
                'name'     => 'Siti Nurhaliza',
                'role'     => 'Penulis — Mobile Development',
                'bio'      => 'Mobile developer berpengalaman dengan keahlian Flutter dan React Native. Telah menerbitkan 5 buku mobile development.',
                'linkedin' => '#',
            ],
        ];

        $values = [
            ['icon' => 'academic-cap', 'title' => 'Mudah Dipahami',   'desc' => 'Setiap buku ditulis dengan bahasa sederhana yang bisa dipahami semua kalangan.'],
            ['icon' => 'code',         'title' => 'Praktis & Nyata',  'desc' => 'Dilengkapi studi kasus dan proyek nyata yang bisa langsung dipraktikkan.'],
            ['icon' => 'users',        'title' => 'Komunitas Aktif',  'desc' => 'Bergabung dengan ribuan developer Indonesia yang belajar bersama.'],
            ['icon' => 'star',         'title' => 'Kualitas Terjamin','desc' => 'Setiap buku melalui proses review teknis yang ketat sebelum diterbitkan.'],
        ];

        $timeline = [
            ['year' => '2018', 'title' => 'Berdiri',                 'desc' => 'MariBelajarCoding didirikan dengan misi menyediakan buku coding berkualitas dalam Bahasa Indonesia.'],
            ['year' => '2019', 'title' => 'Buku Pertama',            'desc' => 'Meluncurkan buku perdana "Belajar PHP dari Nol" yang terjual lebih dari 5.000 eksemplar.'],
            ['year' => '2020', 'title' => 'Ekspansi Digital',        'desc' => 'Meluncurkan versi e-book dan platform belajar online untuk menjangkau lebih banyak pembaca.'],
            ['year' => '2022', 'title' => '10.000 Pembaca',          'desc' => 'Mencapai milestone 10.000 pembaca aktif dan 30+ judul buku yang tersedia.'],
            ['year' => '2024', 'title' => 'Platform Modern',         'desc' => 'Meluncurkan website baru dengan fitur lengkap dan pengalaman belanja yang lebih baik.'],
        ];

        return view('public.about', compact('team', 'values', 'timeline'));
    }
}
