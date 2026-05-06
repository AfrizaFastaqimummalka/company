<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'MariBelajarCoding — Platform buku pemrograman terpercaya untuk developer Indonesia.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MariBelajarCoding') — @yield('title_suffix', 'Platform Buku Pemrograman Indonesia')</title>

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="noise">

    {{-- ── Navbar ── --}}
    @include('components.navbar')

    {{-- ── Page Content ── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── Footer ── --}}
    @include('components.footer')

    {{-- ── Lightbox ── --}}
    <div id="lightbox" class="hidden fixed inset-0 z-[9000] bg-stone-900/90 backdrop-blur-md items-center justify-center p-4">
        <img id="lightbox-img" src="" alt="Gallery image" class="max-w-full max-h-[90vh] rounded-2xl shadow-2xl object-contain">
        <button onclick="document.getElementById('lightbox').classList.add('hidden'); document.getElementById('lightbox').classList.remove('flex');"
                class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors">
            @include('components.icon', ['name' => 'x', 'class' => 'w-5 h-5'])
        </button>
    </div>

    @stack('scripts')
</body>
</html>
