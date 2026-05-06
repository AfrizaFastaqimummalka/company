<footer class="bg-stone-900 text-stone-300">

    <div class="container-main py-16 lg:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Brand --}}
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="font-display font-semibold text-white text-lg">
                        Mari<span class="text-brand-400">BelajarCoding</span>
                    </span>
                </a>
                <p class="text-stone-400 leading-relaxed max-w-sm text-sm">
                    Platform buku pemrograman terpercaya untuk developer Indonesia. Dari pemula hingga profesional, kami hadir dengan konten berkualitas tinggi.
                </p>
                <div class="flex items-center gap-3 mt-6">
                    @foreach(['instagram', 'twitter', 'youtube'] as $social)
                        <a href="#" class="w-9 h-9 rounded-full bg-stone-800 border border-stone-700 flex items-center justify-center
                                           text-stone-400 hover:bg-brand-500 hover:border-brand-500 hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                @if($social === 'instagram')
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor"/>
                                @elseif($social === 'twitter')
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                                @else
                                    <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
                                    <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/>
                                @endif
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Navigasi</h4>
                <ul class="space-y-3 text-sm">
                    @foreach([
                        ['Home', 'home'],
                        ['Tentang Kami', 'about'],
                        ['Katalog Buku', 'services'],
                        ['Galeri', 'gallery'],
                        ['Kontak', 'contact']
                    ] as [$label, $route])
                        <li>
                            <a href="{{ route($route) }}"
                               class="text-stone-400 hover:text-white transition-colors duration-200">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Kontak Kami</h4>
                <ul class="space-y-3 text-sm text-stone-400">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:info@maribelajarcoding.site" class="hover:text-white transition-colors">
                            info@maribelajarcoding.site
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +62 812 3456 7890
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Jakarta, Indonesia
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-stone-800">
        <div class="container-main py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-stone-500">
            <span>&copy; {{ date('Y') }} MariBelajarCoding. All rights reserved.</span>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-stone-300 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-stone-300 transition-colors">Syarat & Ketentuan</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-stone-300 transition-colors">Admin Panel</a>
                @else
                    <a href="{{ route('admin.login') }}" class="hover:text-stone-300 transition-colors">Admin</a>
                @endauth
            </div>
        </div>
    </div>
</footer>
