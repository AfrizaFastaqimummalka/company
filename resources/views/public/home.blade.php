@extends('layouts.app')

@section('title', 'Home')
@section('title_suffix', 'Platform Buku Pemrograman Indonesia')
@section('meta_description', 'MariBelajarCoding — Platform buku pemrograman terpercaya untuk developer Indonesia. Belajar PHP, Laravel, JavaScript, Python dan lebih banyak lagi.')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────────────── --}}
<section class="relative min-h-[100dvh] flex items-center overflow-hidden bg-stone-50">

    {{-- Background --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0"
             style="background-image: linear-gradient(to right, rgba(0,0,0,0.04) 1px, transparent 1px),
                                      linear-gradient(to bottom, rgba(0,0,0,0.04) 1px, transparent 1px);
                    background-size: 48px 48px;"></div>
        <div class="absolute -top-40 -right-40 w-[600px] h-[600px] rounded-full opacity-[0.06]"
             style="background: radial-gradient(circle, #38927a, transparent 70%);"></div>
        <div class="absolute -bottom-20 -left-20 w-[400px] h-[400px] rounded-full opacity-[0.04]"
             style="background: radial-gradient(circle, #38927a, transparent 70%);"></div>
    </div>

    <div class="container-main relative pt-28 pb-16 lg:pt-36 lg:pb-24">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Left: Content --}}
            <div>
                <div class="animate-fade-up">
                    <span class="section-label mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
                        📚 Platform Buku Coding #1 Indonesia
                    </span>
                </div>

                <h1 class="heading-xl text-stone-900 mt-4 animate-fade-up animation-delay-100">
                    Kuasai <span class="text-brand-500 font-display italic">Programming</span><br>
                    Lewat Buku yang<br>
                    <span class="relative inline-block">
                        Tepat & Terstruktur
                        <svg class="absolute -bottom-1 left-0 w-full" height="6" viewBox="0 0 300 6" preserveAspectRatio="none">
                            <path d="M0 5 Q150 0 300 5" stroke="#38927a" stroke-width="2.5" fill="none" stroke-linecap="round" opacity="0.5"/>
                        </svg>
                    </span>
                </h1>

                <p class="lead mt-6 animate-fade-up animation-delay-200">
                    Kami menyediakan buku-buku pemrograman berkualitas tinggi dalam Bahasa Indonesia — dari PHP, Laravel, JavaScript, Python hingga Mobile Development.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mt-8 animate-fade-up animation-delay-300">
                    <a href="{{ route('services') }}" class="btn-primary">
                        📖 Lihat Katalog Buku
                        @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4'])
                    </a>
                    <a href="{{ route('contact') }}" class="btn-secondary">
                        Hubungi Kami
                    </a>
                </div>

                {{-- Stats badges --}}
                <div class="flex flex-wrap items-center gap-6 mt-10 animate-fade-up animation-delay-400">
                    @foreach([
                        ['50+', 'Judul Buku'],
                        ['10K+', 'Pembaca'],
                        ['4.9⭐', 'Rating'],
                    ] as [$val, $label])
                        <div class="text-center">
                            <p class="text-xl font-bold text-stone-900">{{ $val }}</p>
                            <p class="text-xs text-stone-500">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Book Visual --}}
            <div class="relative animate-fade-up animation-delay-200">
                <div class="relative">
                    <div class="absolute -inset-4 rounded-3xl"
                         style="background: linear-gradient(135deg, rgba(56,146,122,0.08), rgba(56,146,122,0.02)); border: 1px solid rgba(56,146,122,0.1);"></div>

                    {{-- Book showcase --}}
                    <div class="relative rounded-2xl overflow-hidden bg-white shadow-card border border-stone-100 p-8"
                         style="background: linear-gradient(135deg, #f0f9f6 0%, #e8f5f0 50%, #f5f9f7 100%);">

                        <div class="grid grid-cols-3 gap-4">
                            @foreach([
                                ['PHP', '#3b82f6', 'Belajar PHP dari Nol'],
                                ['Laravel', '#ef4444', 'Laravel untuk Pemula'],
                                ['JS', '#f59e0b', 'JavaScript Modern'],
                                ['Python', '#10b981', 'Python Data Science'],
                                ['MySQL', '#6366f1', 'Desain Database'],
                                ['Flutter', '#06b6d4', 'Aplikasi Mobile'],
                            ] as [$lang, $color, $title])
                                <div class="rounded-xl p-3 shadow-sm border border-white/60 text-center"
                                     style="background: white;">
                                    <div class="w-10 h-10 rounded-lg mx-auto mb-2 flex items-center justify-center text-white text-xs font-bold"
                                         style="background: {{ $color }};">
                                        {{ $lang }}
                                    </div>
                                    <p class="text-[10px] text-stone-600 font-medium leading-tight">{{ $title }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-5 border-t border-stone-100 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-stone-500">Total Koleksi</p>
                                <p class="text-2xl font-bold text-brand-600">50+ Buku</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-stone-500">Bahasa</p>
                                <p class="text-2xl font-bold text-stone-800">Indonesia</p>
                            </div>
                        </div>
                    </div>

                    {{-- Floating badges --}}
                    <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-soft border border-stone-100 px-4 py-3 animate-float">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">📚</span>
                            <div>
                                <p class="text-xs font-semibold text-stone-800">Buku Baru!</p>
                                <p class="text-[10px] text-stone-400">Update tiap bulan</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-soft border border-stone-100 px-4 py-3 animate-float animation-delay-300">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">⭐</span>
                            <div>
                                <p class="text-xs font-semibold text-stone-800">Rating 4.9/5</p>
                                <p class="text-[10px] text-stone-400">10.000+ pembaca</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MARQUEE TEKNOLOGI ─────────────────────────────────────────────────── --}}
<section class="py-10 bg-white border-y border-stone-100 overflow-hidden">
    <div class="relative">
        <div class="marquee-track animate-marquee flex items-center gap-12 w-max whitespace-nowrap">
            @for($i = 0; $i < 2; $i++)
                @foreach(['PHP', 'Laravel', 'JavaScript', 'Python', 'MySQL', 'Flutter', 'React', 'Node.js', 'Vue.js', 'CodeIgniter'] as $tech)
                    <span class="text-stone-300 font-display font-semibold text-lg tracking-wide hover:text-stone-500 transition-colors duration-300 cursor-default">
                        {{ $tech }}
                    </span>
                @endforeach
            @endfor
        </div>
    </div>
</section>

{{-- ── STATS ─────────────────────────────────────────────────────────────── --}}
<section class="section bg-stone-50">
    <div class="container-main">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-0 lg:divide-x lg:divide-stone-200">
            @foreach($stats as $stat)
                <div class="text-center lg:px-10 animate-on-scroll">
                    <div class="heading-xl text-brand-500">
                        <span data-counter data-target="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] }}
                    </div>
                    <p class="text-sm text-stone-500 mt-2 font-medium">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── ABOUT PREVIEW ─────────────────────────────────────────────────────── --}}
<section class="section bg-white">
    <div class="container-main">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div class="relative animate-on-scroll">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="rounded-2xl overflow-hidden aspect-square bg-brand-50 border border-brand-100 flex items-center justify-center">
                            <div class="text-center p-6">
                                <p class="text-5xl">📖</p>
                                <p class="font-bold text-brand-600 mt-2 text-lg">50+</p>
                                <p class="text-xs text-brand-500 font-medium">Judul Buku</p>
                            </div>
                        </div>
                        <div class="rounded-2xl overflow-hidden aspect-video"
                             style="background: linear-gradient(135deg, #1c4037 0%, #38927a 100%);">
                            <div class="p-5 h-full flex flex-col justify-end">
                                <p class="text-white font-display font-semibold text-lg leading-tight">Bahasa Indonesia</p>
                                <p class="text-brand-200 text-xs mt-1">Mudah dipahami</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div class="rounded-2xl overflow-hidden aspect-video bg-amber-50 border border-amber-100">
                            <div class="p-5 h-full flex flex-col justify-between">
                                <span class="text-3xl">🏆</span>
                                <div>
                                    <p class="font-semibold text-stone-800 text-sm">Terpercaya</p>
                                    <p class="text-stone-500 text-xs">Sejak 2018</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-2xl overflow-hidden aspect-square bg-stone-900 flex items-center justify-center">
                            <div class="text-center p-4">
                                <p class="text-4xl font-bold text-white">10K<span class="text-brand-400">+</span></p>
                                <p class="text-stone-400 text-xs mt-1">Pembaca Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="animate-on-scroll animation-delay-200">
                <span class="section-label">Tentang Kami</span>

                <h2 class="heading-lg mt-4">
                    Belajar Coding Jadi<br>
                    <span class="text-brand-500 font-display italic">Lebih Mudah & Menyenangkan</span>
                </h2>

                <p class="lead mt-4">
                    MariBelajarCoding hadir sejak 2018 sebagai platform buku pemrograman berbahasa Indonesia yang membantu ribuan developer berkembang.
                </p>

                <p class="text-stone-500 leading-relaxed mt-3 text-sm max-w-[55ch]">
                    Setiap buku kami ditulis oleh praktisi berpengalaman dengan bahasa yang mudah dipahami, dilengkapi studi kasus nyata yang bisa langsung dipraktikkan.
                </p>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    @foreach([
                        ['icon' => 'academic-cap', 'title' => 'Ditulis Praktisi',    'desc' => 'Oleh developer berpengalaman'],
                        ['icon' => 'globe',         'title' => 'Bahasa Indonesia',   'desc' => 'Mudah dipahami semua kalangan'],
                        ['icon' => 'code',          'title' => 'Studi Kasus Nyata',  'desc' => 'Langsung bisa dipraktikkan'],
                        ['icon' => 'star',          'title' => 'Rating Tinggi',      'desc' => 'Rata-rata 4.9/5 dari pembaca'],
                    ] as $item)
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                @include('components.icon', ['name' => $item['icon'], 'class' => 'w-4 h-4 text-brand-600'])
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-stone-800">{{ $item['title'] }}</p>
                                <p class="text-xs text-stone-500">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('about') }}" class="btn-primary mt-8 inline-flex">
                    Selengkapnya
                    @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4'])
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── FEATURED BOOKS ────────────────────────────────────────────────────── --}}
<section class="section bg-stone-50">
    <div class="container-main">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-14">
            <div class="animate-on-scroll">
                <span class="section-label">Katalog Buku</span>
                <h2 class="heading-lg mt-4">
                    Buku Pilihan<br>
                    <span class="text-brand-500 font-display italic">Terpopuler</span>
                </h2>
            </div>
            <a href="{{ route('services') }}" class="btn-secondary self-start lg:self-auto animate-on-scroll">
                Lihat Semua Buku
                @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4'])
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($featuredServices as $i => $book)
                <a href="{{ route('services.show', $book->slug) }}"
                   class="card-hover p-8 group animate-on-scroll"
                   style="animation-delay: {{ $i * 100 }}ms;">

                    <div class="w-12 h-12 rounded-2xl bg-brand-50 border border-brand-100 flex items-center justify-center mb-6
                                group-hover:bg-brand-500 group-hover:border-brand-500 transition-all duration-300">
                        @include('components.icon', ['name' => $book->icon, 'class' => 'w-6 h-6 text-brand-600 group-hover:text-white transition-colors duration-300'])
                    </div>

                    <h3 class="font-semibold text-stone-900 text-lg mb-3 group-hover:text-brand-600 transition-colors">
                        {{ $book->title }}
                    </h3>

                    <p class="text-stone-500 text-sm leading-relaxed">
                        {{ $book->excerpt }}
                    </p>

                    <div class="flex items-center gap-2 mt-6 text-brand-600 text-sm font-medium">
                        Lihat Detail
                        @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4 group-hover:translate-x-1 transition-transform'])
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ── TESTIMONIAL ───────────────────────────────────────────────────────── --}}
<section class="section bg-white">
    <div class="container-main">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <svg class="w-12 h-12 text-brand-200 mx-auto mb-6" fill="currentColor" viewBox="0 0 32 32">
                <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/>
            </svg>

            <blockquote class="font-display text-2xl lg:text-3xl font-medium text-stone-800 leading-snug">
                "Buku Laravel dari MariBelajarCoding benar-benar mengubah cara saya belajar. Penjelasannya sangat mudah dipahami dan langsung bisa dipraktikkan!"
            </blockquote>

            <div class="flex items-center justify-center gap-3 mt-8">
                <div class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-700 font-bold text-sm">
                    AR
                </div>
                <div class="text-left">
                    <p class="text-sm font-semibold text-stone-800">Ahmad Rizky</p>
                    <p class="text-xs text-stone-500">Web Developer, Jakarta</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA ───────────────────────────────────────────────────────────────── --}}
<section class="section-sm">
    <div class="container-main">
        <div class="relative rounded-3xl overflow-hidden animate-on-scroll"
             style="background: linear-gradient(135deg, #1c4037 0%, #2a7562 40%, #38927a 100%);">

            <div class="absolute top-0 right-0 w-80 h-80 rounded-full opacity-10"
                 style="background: radial-gradient(circle, #7bc4b0, transparent 70%); transform: translate(30%, -30%);"></div>

            <div class="relative px-8 py-16 lg:px-16 lg:py-20 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="font-display text-3xl lg:text-4xl font-bold text-white leading-tight">
                        Siap Mulai Belajar<br>Pemrograman?
                    </h2>
                    <p class="text-brand-200 mt-3 max-w-lg leading-relaxed">
                        Temukan buku yang tepat untuk level kamu — dari pemula hingga advanced. Semua dalam Bahasa Indonesia!
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                    <a href="{{ route('services') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-brand-700 font-semibold rounded-xl
                              hover:bg-stone-50 active:scale-[0.98] transition-all duration-200 shadow-sm">
                        📚 Lihat Katalog Buku
                        @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4'])
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 border border-white/30 text-white font-medium rounded-xl
                              hover:bg-white/10 active:scale-[0.98] transition-all duration-200">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
