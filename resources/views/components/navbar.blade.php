<nav id="navbar" class="fixed top-0 inset-x-0 z-50 transition-all duration-300">

    <style>
        #navbar { background: transparent; }
        #navbar.navbar-scrolled {
            background: rgba(250,250,249,0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(231,229,228,0.8);
            box-shadow: 0 1px 20px -4px rgba(0,0,0,0.06);
        }
    </style>

    <div class="container-main">
        <div class="flex items-center justify-between h-16 lg:h-[70px]">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center shadow-sm
                            group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="font-display font-semibold text-stone-900 text-lg tracking-tight">
                    Mari<span class="text-brand-500">BelajarCoding</span>
                </span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $links = [
                        ['route' => 'home',     'label' => 'Home'],
                        ['route' => 'about',    'label' => 'Tentang Kami'],
                        ['route' => 'services', 'label' => 'Katalog Buku'],
                        ['route' => 'gallery',  'label' => 'Galeri'],
                        ['route' => 'contact',  'label' => 'Kontak'],
                    ];
                @endphp

                @foreach($links as $link)
                    <a href="{{ route($link['route']) }}"
                       class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs($link['route']) ? 'text-brand-600' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('services') }}" class="btn-primary text-sm py-2.5">
                    📚 Lihat Buku
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Mobile toggle --}}
            <button id="menu-btn"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    class="lg:hidden p-2 rounded-xl text-stone-600 hover:bg-stone-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu"
         class="lg:hidden overflow-hidden bg-white border-t border-stone-100"
         style="max-height: 0; transition: max-height 0.3s ease;">
        <div class="container-main py-4 space-y-1">
            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="flex items-center px-4 py-3 rounded-xl text-sm font-medium text-stone-700
                          hover:bg-brand-50 hover:text-brand-700 transition-colors
                          {{ request()->routeIs($link['route']) ? 'bg-brand-50 text-brand-700' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="pt-3 pb-1">
                <a href="{{ route('services') }}" class="btn-primary w-full justify-center text-sm">
                    📚 Lihat Buku
                </a>
            </div>
        </div>
    </div>
</nav>
