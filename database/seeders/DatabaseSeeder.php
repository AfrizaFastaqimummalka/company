<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ─────────────────────────────────────────────────────
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@maribelajarcoding.site',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // ── Buku (Services) ───────────────────────────────────────────────
        $books = [
            [
                'title'       => 'Belajar PHP dari Nol',
                'slug'        => 'belajar-php-dari-nol',
                'excerpt'     => 'Panduan lengkap belajar PHP untuk pemula hingga mahir. Cocok untuk yang baru memulai dunia pemrograman web.',
                'description' => 'Buku ini membahas dasar-dasar PHP mulai dari sintaks, variabel, fungsi, OOP, hingga koneksi database MySQL. Dilengkapi dengan studi kasus membuat aplikasi web sederhana yang bisa langsung dipraktikkan.',
                'icon'        => 'code',
                'is_featured' => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Pemrograman Laravel untuk Pemula',
                'slug'        => 'pemrograman-laravel-untuk-pemula',
                'excerpt'     => 'Kuasai framework Laravel dari dasar hingga membuat aplikasi web modern yang profesional.',
                'description' => 'Buku panduan lengkap Laravel yang membahas routing, controller, model, migration, Blade template, hingga authentication. Dilengkapi project nyata membuat sistem manajemen konten.',
                'icon'        => 'sparkles',
                'is_featured' => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'JavaScript Modern & ES6+',
                'slug'        => 'javascript-modern-es6',
                'excerpt'     => 'Pelajari JavaScript modern dengan fitur ES6+ yang digunakan oleh developer profesional di seluruh dunia.',
                'description' => 'Membahas fitur modern JavaScript seperti arrow function, destructuring, async/await, module, dan banyak lagi. Termasuk praktik membuat aplikasi interaktif menggunakan vanilla JavaScript.',
                'icon'        => 'light-bulb',
                'is_featured' => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Belajar Python untuk Data Science',
                'slug'        => 'belajar-python-data-science',
                'excerpt'     => 'Kuasai Python dan library populer seperti Pandas, NumPy, dan Matplotlib untuk analisis data.',
                'description' => 'Panduan komprehensif Python untuk data science yang membahas manipulasi data, visualisasi, machine learning dasar, dan implementasi proyek nyata analisis data.',
                'icon'        => 'chart-bar',
                'is_featured' => false,
                'sort_order'  => 4,
            ],
            [
                'title'       => 'Desain Database dengan MySQL',
                'slug'        => 'desain-database-mysql',
                'excerpt'     => 'Pelajari cara merancang database yang efisien dan optimal menggunakan MySQL.',
                'description' => 'Buku ini membahas konsep dasar database, normalisasi, relasi antar tabel, query SQL tingkat lanjut, stored procedure, dan optimasi performa database.',
                'icon'        => 'database',
                'is_featured' => false,
                'sort_order'  => 5,
            ],
            [
                'title'       => 'Membangun Aplikasi Mobile dengan Flutter',
                'slug'        => 'membangun-aplikasi-mobile-flutter',
                'excerpt'     => 'Buat aplikasi Android dan iOS sekaligus menggunakan Flutter dan Dart dari nol.',
                'description' => 'Panduan lengkap pengembangan aplikasi mobile cross-platform dengan Flutter. Membahas widget, state management, navigasi, API integration, dan publikasi ke App Store & Play Store.',
                'icon'        => 'device-mobile',
                'is_featured' => false,
                'sort_order'  => 6,
            ],
        ];

        foreach ($books as $book) {
            Service::create($book);
        }

        // ── Gallery ───────────────────────────────────────────────────────
        $galleries = [
            ['title' => 'Peluncuran Buku PHP 2024',        'category' => 'event',     'sort_order' => 1],
            ['title' => 'Workshop Laravel Batch 5',        'category' => 'workshop',  'sort_order' => 2],
            ['title' => 'Booth Pameran Buku Komputer',     'category' => 'event',     'sort_order' => 3],
            ['title' => 'Sesi Belajar Bersama Online',     'category' => 'workshop',  'sort_order' => 4],
            ['title' => 'Koleksi Buku Programming 2024',   'category' => 'buku',      'sort_order' => 5],
            ['title' => 'Meetup Komunitas Developer',      'category' => 'event',     'sort_order' => 6],
            ['title' => 'Tim Penulis & Editor',            'category' => 'tim',       'sort_order' => 7],
            ['title' => 'Proses Penulisan Buku',           'category' => 'tim',       'sort_order' => 8],
            ['title' => 'Seminar Pemrograman Web',         'category' => 'workshop',  'sort_order' => 9],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create(array_merge($gallery, [
                'image'   => null,
                'caption' => 'Dokumentasi ' . $gallery['title'],
            ]));
        }
    }
}
