@extends('layouts.app')

@section('title', $service->title)
@section('title_suffix', 'Detail Buku')
@section('meta_description', $service->excerpt)

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 lg:pt-36 lg:pb-20 bg-white border-b border-stone-100">
    <div class="container-main">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-stone-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-stone-600 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('services') }}" class="hover:text-stone-600 transition-colors">Katalog Buku</a>
            <span>/</span>
            <span class="text-stone-600">{{ $service->title }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-start">

            {{-- Kiri: Info Buku --}}
            <div>
                @if($service->is_featured)
                    <span class="badge badge-success mb-4">⭐ Buku Terpopuler</span>
                @endif

                <h1 class="heading-xl">{{ $service->title }}</h1>
                <p class="lead mt-4">{{ $service->excerpt }}</p>

                {{-- Cover Buku --}}
                @if($service->image)
                    <div class="mt-8">
                        <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-3">Cover Buku</p>
                        <img src="{{ asset('storage/' . $service->image) }}"
                             alt="Cover {{ $service->title }}"
                             class="w-36 rounded-xl shadow-card border border-stone-100 object-cover">
                    </div>
                @endif

                <div class="flex flex-wrap gap-3 mt-8">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        📩 Tanya / Pesan Buku Ini
                        @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4'])
                    </a>
                    <a href="{{ route('services') }}" class="btn-secondary">
                        Lihat Buku Lainnya
                    </a>
                </div>
            </div>

            {{-- Kanan: Info card --}}
            <div class="card p-8">
                <h3 class="font-semibold text-stone-900 mb-5">📋 Yang Akan Kamu Pelajari</h3>
                <ul class="space-y-3">
                    @foreach([
                        'Materi terstruktur dari dasar hingga mahir',
                        'Studi kasus & proyek nyata yang bisa dipraktikkan',
                        'Penjelasan dalam Bahasa Indonesia yang mudah dipahami',
                        'Tips & trik dari praktisi berpengalaman',
                        'Latihan soal di setiap bab',
                    ] as $item)
                        <li class="flex items-center gap-3 text-sm text-stone-600">
                            @include('components.icon', ['name' => 'check-circle', 'class' => 'w-4 h-4 text-brand-500 flex-shrink-0'])
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>

                {{-- Tampilkan cover di card juga kalau ada --}}
                @if($service->image)
                    <div class="mt-6 pt-6 border-t border-stone-100">
                        <img src="{{ asset('storage/' . $service->image) }}"
                             alt="Cover {{ $service->title }}"
                             class="w-32 h-44 rounded-xl object-cover shadow-sm border border-stone-100 mx-auto">
                    </div>
                @else
                    {{-- Placeholder kalau belum ada cover --}}
                    <div class="mt-6 pt-6 border-t border-stone-100">
                        <div class="w-full rounded-xl bg-brand-50 border border-brand-100 flex items-center justify-center py-10">
                            @include('components.icon', ['name' => 'book', 'class' => 'w-16 h-16 text-brand-300'])
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Deskripsi lengkap --}}
@if($service->description)
    <section class="section bg-stone-50">
        <div class="container-main">
            <div class="max-w-3xl mx-auto">
                <h2 class="heading-md mb-6">📖 Deskripsi Buku</h2>
                <div class="prose prose-stone max-w-none text-stone-600 leading-relaxed text-base">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>
        </div>
    </section>
@endif

{{-- Buku lainnya --}}
@if($related->isNotEmpty())
    <section class="section bg-white">
        <div class="container-main">
            <h2 class="heading-md mb-8">📚 Buku Lainnya yang Mungkin Kamu Suka</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($related as $rel)
                    <a href="{{ route('services.show', $rel->slug) }}" class="card-hover p-7 group">
                        {{-- Tampilkan cover kalau ada, kalau tidak tampilkan icon --}}
                        @if($rel->image)
                            <img src="{{ asset('storage/' . $rel->image) }}"
                                 alt="Cover {{ $rel->title }}"
                                 class="w-full h-32 object-cover rounded-xl mb-4 border border-stone-100">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center mb-4
                                        group-hover:bg-brand-500 transition-all duration-300">
                                @include('components.icon', ['name' => 'book', 'class' => 'w-5 h-5 text-brand-600 group-hover:text-white transition-colors duration-300'])
                            </div>
                        @endif

                        <h3 class="font-semibold text-stone-900 mb-2 group-hover:text-brand-600 transition-colors">
                            {{ $rel->title }}
                        </h3>
                        <p class="text-stone-500 text-sm leading-relaxed">{{ $rel->excerpt }}</p>

                        <div class="flex items-center gap-1 mt-4 text-brand-600 text-sm font-medium">
                            Lihat Detail
                            @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4 group-hover:translate-x-1 transition-transform'])
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection