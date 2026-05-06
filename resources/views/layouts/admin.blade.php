<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-stone-50 font-sans antialiased">

<div class="flex h-full min-h-screen">

    {{-- ── Sidebar ── --}}
    <aside class="hidden lg:flex flex-col w-64 bg-white border-r border-stone-100 fixed inset-y-0 z-30">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-stone-100">
            <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="font-semibold text-stone-900 text-sm">Panel Admin</span>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <p class="px-4 text-[10px] font-semibold uppercase tracking-widest text-stone-400 mb-2">Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                @include('components.icon', ['name' => 'home', 'class' => 'w-5 h-5'])
                Dashboard
            </a>

            <p class="px-4 text-[10px] font-semibold uppercase tracking-widest text-stone-400 mb-2 mt-4">Konten</p>

            <a href="{{ route('admin.services.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                @include('components.icon', ['name' => 'book', 'class' => 'w-5 h-5'])
                Katalog Buku
            </a>

            <a href="{{ route('admin.gallery.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                @include('components.icon', ['name' => 'photograph', 'class' => 'w-5 h-5'])
                Galeri
            </a>

            <a href="{{ route('admin.contacts.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                @include('components.icon', ['name' => 'mail', 'class' => 'w-5 h-5'])
                Pesan Masuk
                @php $unread = \App\Models\Contact::unread()->count(); @endphp
                @if($unread > 0)
                    <span class="ml-auto text-xs bg-red-500 text-white font-semibold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $unread > 9 ? '9+' : $unread }}
                    </span>
                @endif
            </a>
        </nav>

        {{-- User footer --}}
        <div class="px-3 py-4 border-t border-stone-100">
            <div class="flex items-center gap-3 px-3 py-2 rounded-xl">
                <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-brand-700 font-semibold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-stone-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-stone-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-1">
                @csrf
                <button type="submit" class="sidebar-link w-full text-red-500 hover:bg-red-50 hover:text-red-600 mt-1">
                    @include('components.icon', ['name' => 'logout', 'class' => 'w-5 h-5'])
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Konten Utama ── --}}
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">

        {{-- Top bar --}}
        <header class="bg-white border-b border-stone-100 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
            <div>
                <h1 class="text-base font-semibold text-stone-900">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-stone-500">@yield('breadcrumb', 'Panel Admin')</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn-ghost text-xs">
                    @include('components.icon', ['name' => 'external-link', 'class' => 'w-4 h-4'])
                    Lihat Website
                </a>
            </div>
        </header>

        {{-- Konten --}}
        <main class="flex-1 p-6">

            {{-- Flash messages --}}
            @if(session('success'))
                <div data-auto-dismiss="4000"
                     class="mb-6 flex items-center gap-3 px-4 py-3 bg-green-50 text-green-700 border border-green-100 rounded-xl text-sm font-medium">
                    @include('components.icon', ['name' => 'check-circle', 'class' => 'w-5 h-5 flex-shrink-0'])
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div data-auto-dismiss="5000"
                     class="mb-6 flex items-center gap-3 px-4 py-3 bg-red-50 text-red-700 border border-red-100 rounded-xl text-sm font-medium">
                    @include('components.icon', ['name' => 'exclamation-circle', 'class' => 'w-5 h-5 flex-shrink-0'])
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
