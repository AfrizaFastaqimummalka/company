@extends('layouts.app')

@section('title', 'Tentang Kami')
@section('title_suffix', 'Kisah & Tim Kami')
@section('meta_description', 'Kenali MariBelajarCoding — misi kami, nilai-nilai yang kami pegang, dan tim penulis berpengalaman di balik buku-buku pemrograman terbaik Indonesia.')

@section('content')

{{-- Page Header --}}
<section class="pt-28 pb-16 lg:pt-36 lg:pb-20 bg-white border-b border-stone-100">
    <div class="container-main">
        <div class="max-w-3xl">
            <span class="section-label">Tentang MariBelajarCoding</span>
            <h1 class="heading-xl mt-4">
                Dibangun dengan Dedikasi,<br>
                <span class="text-brand-500 font-display italic">Untuk Developer Indonesia</span>
            </h1>
            <p class="lead mt-6">
                Sejak 2018, kami telah membantu ribuan developer Indonesia tumbuh dan berkembang melalui buku-buku pemrograman berkualitas tinggi yang ditulis dalam Bahasa Indonesia.
            </p>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="section bg-stone-50">
    <div class="container-main">
        <div class="grid lg:grid-cols-2 gap-12">
            <div class="animate-on-scroll">
                <div class="w-12 h-12 rounded-2xl bg-brand-500 flex items-center justify-center mb-6">
                    @include('components.icon', ['name' => 'star', 'class' => 'w-6 h-6 text-white'])
                </div>
                <h2 class="heading-md mb-4">Misi Kami</h2>
                <p class="text-stone-500 leading-relaxed">
                    Menjadi platform buku pemrograman berbahasa Indonesia yang paling dipercaya — menghadirkan materi yang jelas, praktis, dan mudah dipahami oleh semua kalangan developer.
                </p>
            </div>
            <div class="animate-on-scroll animation-delay-100">
                <div class="w-12 h-12 rounded-2xl bg-stone-900 flex items-center justify-center mb-6">
                    @include('components.icon', ['name' => 'globe', 'class' => 'w-6 h-6 text-white'])
                </div>
                <h2 class="heading-md mb-4">Visi Kami</h2>
                <p class="text-stone-500 leading-relaxed">
                    Indonesia di mana setiap programmer — dari pemula hingga profesional — memiliki akses ke sumber belajar pemrograman berkualitas dunia dalam Bahasa Indonesia yang mudah dipahami.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="section bg-white">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-14 animate-on-scroll">
            <span class="section-label">Fondasi Kami</span>
            <h2 class="heading-lg mt-4">Nilai yang Kami Pegang</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($values as $i => $value)
                <div class="card p-7 text-center animate-on-scroll" style="animation-delay: {{ $i * 80 }}ms;">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center mx-auto mb-5">
                        @include('components.icon', ['name' => $value['icon'], 'class' => 'w-6 h-6 text-brand-600'])
                    </div>
                    <h3 class="font-semibold text-stone-900 mb-2">{{ $value['title'] }}</h3>
                    <p class="text-stone-500 text-sm leading-relaxed">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Timeline --}}
<section class="section bg-stone-50">
    <div class="container-main">
        <div class="max-w-2xl mx-auto mb-14 animate-on-scroll">
            <span class="section-label">Perjalanan Kami</span>
            <h2 class="heading-lg mt-4">Pencapaian yang Membentuk Kami</h2>
        </div>

        <div class="relative max-w-3xl mx-auto">
            {{-- Vertical line --}}
            <div class="absolute left-6 top-0 bottom-0 w-px bg-stone-200 hidden md:block"></div>

            <div class="space-y-8">
                @foreach($timeline as $i => $item)
                    <div class="flex gap-6 animate-on-scroll" style="animation-delay: {{ $i * 100 }}ms;">
                        {{-- Year dot --}}
                        <div class="relative flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-white border-2 border-brand-200 flex items-center justify-center z-10 relative shadow-sm">
                                <span class="text-xs font-bold text-brand-600">{{ substr($item['year'], 2) }}</span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="card p-6 flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-sm font-bold text-brand-500 font-mono">{{ $item['year'] }}</span>
                                <h3 class="font-semibold text-stone-900">{{ $item['title'] }}</h3>
                            </div>
                            <p class="text-stone-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Team --}}
<section class="section bg-white">
    <div class="container-main">
        <div class="text-center max-w-2xl mx-auto mb-14 animate-on-scroll">
            <span class="section-label">Tim Kami</span>
            <h2 class="heading-lg mt-4">Tim Penulis & Editor</h2>
            <p class="lead mt-3 mx-auto text-center">
                Para praktisi berpengalaman yang mencurahkan keahlian dan dedikasi penuh di setiap buku yang kami terbitkan.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($team as $i => $member)
                <div class="card-hover p-6 text-center group animate-on-scroll" style="animation-delay: {{ $i * 80 }}ms;">
                    {{-- Avatar --}}
                    <div class="w-20 h-20 rounded-2xl mx-auto mb-5 flex items-center justify-center
                                text-2xl font-bold font-display text-white
                                group-hover:scale-105 transition-transform duration-300"
                         style="background: linear-gradient(135deg, #38927a, #245f50);">
                        {{ substr($member['name'], 0, 1) }}
                    </div>

                    <h3 class="font-semibold text-stone-900 mb-0.5">{{ $member['name'] }}</h3>
                    <p class="text-xs text-brand-600 font-medium mb-3">{{ $member['role'] }}</p>
                    <p class="text-stone-500 text-xs leading-relaxed">{{ $member['bio'] }}</p>

                    <a href="{{ $member['linkedin'] }}"
                       class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-stone-100 text-stone-500
                              hover:bg-brand-500 hover:text-white transition-all duration-200 mt-4">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z M4 6a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="section-sm bg-stone-50">
    <div class="container-main text-center animate-on-scroll">
        <h2 class="heading-md mb-3">Siap Mulai Belajar Bersama Kami?</h2>
        <p class="lead mx-auto text-center mb-6">Temukan buku yang tepat untuk perjalanan belajar coding kamu.</p>
        <a href="{{ route('contact') }}" class="btn-primary">
            Hubungi Kami
            @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4'])
        </a>
    </div>
</section>

@endsection
