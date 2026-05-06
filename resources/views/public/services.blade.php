@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('title_suffix', 'Semua Buku Pemrograman')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 lg:pt-36 lg:pb-20 bg-white border-b border-stone-100">
    <div class="container-main">
        <div class="max-w-3xl">
            <span class="section-label">📚 Katalog Buku</span>
            <h1 class="heading-xl mt-4">
                Temukan Buku yang<br>
                <span class="text-brand-500 font-display italic">Tepat untuk Kamu</span>
            </h1>
            <p class="lead mt-6">
                Koleksi lengkap buku pemrograman berbahasa Indonesia — dari pemula hingga tingkat lanjut, semua ada di sini.
            </p>
        </div>
    </div>
</section>

{{-- Books Grid --}}
<section class="section bg-stone-50">
    <div class="container-main">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $i => $book)
                <a href="{{ route('services.show', $book->slug) }}"
                   class="card-hover group animate-on-scroll overflow-hidden flex flex-col"
                   style="animation-delay: {{ ($i % 3) * 80 }}ms;">

                    {{-- Area Cover Buku - seperti rak buku --}}
                    <div class="flex items-center justify-center bg-gradient-to-b from-stone-50 to-stone-100 py-8 px-6 border-b border-stone-100 min-h-[220px]">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}"
                                 alt="Cover {{ $book->title }}"
                                 class="h-48 w-auto object-contain rounded-lg shadow-lg
                                        group-hover:scale-105 group-hover:-translate-y-1
                                        transition-all duration-500">
                        @else
                            {{-- Placeholder berbentuk buku portrait --}}
                            <div class="h-48 w-32 rounded-lg shadow-md flex flex-col overflow-hidden"
                                 style="background: linear-gradient(135deg, #38927a, #245f50);">
                                <div class="flex-1 flex items-center justify-center p-4">
                                    <svg class="w-10 h-10 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div class="bg-black/20 px-2 py-1.5">
                                    <p class="text-white text-[9px] font-medium text-center leading-tight truncate">
                                        {{ $book->title }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Info Buku --}}
                    <div class="p-6 flex flex-col flex-1">
                        @if($book->is_featured)
                            <span class="badge badge-success mb-2 self-start">⭐ Terpopuler</span>
                        @endif

                        <h2 class="font-display font-semibold text-lg text-stone-900 mb-2
                                   group-hover:text-brand-600 transition-colors leading-snug">
                            {{ $book->title }}
                        </h2>

                        <p class="text-stone-500 text-sm leading-relaxed flex-1">
                            {{ Str::limit($book->excerpt, 100) }}
                        </p>

                        <div class="flex items-center gap-2 mt-5 text-sm font-medium text-brand-600">
                            Lihat Detail Buku
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($services->isEmpty())
            <div class="text-center py-24 text-stone-400">
                <p class="text-5xl mb-4">📭</p>
                <p class="font-medium">Belum ada buku tersedia.</p>
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="section-sm bg-white">
    <div class="container-main">
        <div class="card p-10 lg:p-14 text-center animate-on-scroll">
            <p class="text-4xl mb-4">🤔</p>
            <h2 class="heading-md">Bingung Pilih Buku Mana?</h2>
            <p class="lead mt-3 mx-auto text-center">
                Hubungi kami dan kami akan bantu rekomendasikan buku yang sesuai dengan level dan tujuan belajar kamu.
            </p>
            <a href="{{ route('contact') }}" class="btn-primary mt-6">
                Minta Rekomendasi
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection