@extends('layouts.app')

@section('title', 'Galeri')
@section('title_suffix', 'Momen & Karya Kami')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 lg:pt-36 lg:pb-20 bg-white border-b border-stone-100">
    <div class="container-main">
        <div class="max-w-3xl">
            <span class="section-label">📸 Galeri</span>
            <h1 class="heading-xl mt-4">
                Momen yang<br>
                <span class="text-brand-500 font-display italic">Bercerita untuk Kami</span>
            </h1>
            <p class="lead mt-6">
                Sekilas tentang kegiatan, tim, dan perjalanan MariBelajarCoding dalam menghadirkan buku-buku coding terbaik untuk developer Indonesia.
            </p>
        </div>
    </div>
</section>

{{-- Gallery --}}
<section class="section bg-stone-50">
    <div class="container-main">

        {{-- Filter tabs --}}
        @if(count($categories) > 1)
            <div class="flex flex-wrap items-center gap-2 mb-10" id="gallery-filters">
                <button class="gallery-filter px-4 py-2 rounded-full text-sm font-medium border border-brand-500 bg-brand-500 text-white transition-all duration-200"
                        data-filter="all">
                    Semua
                </button>
                @foreach($categories as $cat)
                    <button class="gallery-filter px-4 py-2 rounded-full text-sm font-medium border border-stone-200 text-stone-600
                                   hover:border-brand-300 hover:text-brand-600 bg-white transition-all duration-200"
                            data-filter="{{ $cat }}">
                        {{ ucfirst($cat) }}
                    </button>
                @endforeach
            </div>
        @endif

        {{-- Masonry grid --}}
        @if($galleries->isNotEmpty())
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-5 space-y-5" id="gallery-grid">
                @foreach($galleries as $i => $item)
                    <div class="gallery-item break-inside-avoid animate-on-scroll group cursor-pointer"
                         data-category="{{ $item->category }}"
                         style="animation-delay: {{ ($i % 6) * 80 }}ms;">

                        <div class="relative rounded-2xl overflow-hidden bg-stone-100 shadow-card
                                    hover:shadow-hover transition-all duration-300"
                             data-lightbox="{{ $item->image_url }}"
                             title="{{ $item->title }}">

                            {{-- Image --}}
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->title }}"
                                 loading="lazy"
                                 class="w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 style="aspect-ratio: {{ $loop->index % 3 === 1 ? '4/3' : '16/10' }}; object-fit: cover;">

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-900/60 via-transparent to-transparent
                                        opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                                <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-white font-semibold text-sm">{{ $item->title }}</p>
                                    @if($item->caption)
                                        <p class="text-white/70 text-xs mt-0.5">{{ $item->caption }}</p>
                                    @endif
                                    <span class="inline-block mt-2 text-[10px] font-semibold uppercase tracking-wider
                                                 text-white/60 bg-white/10 rounded-full px-2 py-0.5">
                                        {{ $item->category }}
                                    </span>
                                </div>
                            </div>

                            {{-- Zoom icon --}}
                            <div class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm
                                        flex items-center justify-center opacity-0 group-hover:opacity-100
                                        transition-all duration-300 scale-75 group-hover:scale-100">
                                <svg class="w-4 h-4 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 text-stone-400">
                <div class="w-16 h-16 rounded-2xl bg-stone-100 flex items-center justify-center mx-auto mb-4">
                    @include('components.icon', ['name' => 'photograph', 'class' => 'w-8 h-8'])
                </div>
                <p class="font-medium">Belum ada foto di galeri.</p>
                <p class="text-sm mt-1">Segera hadir!</p>
            </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Gallery filter logic
    const filterBtns = document.querySelectorAll('.gallery-filter');
    const items = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;

            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('bg-brand-500', 'border-brand-500', 'text-white');
                b.classList.add('bg-white', 'border-stone-200', 'text-stone-600');
            });
            btn.classList.add('bg-brand-500', 'border-brand-500', 'text-white');
            btn.classList.remove('bg-white', 'border-stone-200', 'text-stone-600');

            // Filter items
            items.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = '';
                    item.style.opacity = '0';
                    requestAnimationFrame(() => {
                        item.style.transition = 'opacity 0.3s ease';
                        item.style.opacity = '1';
                    });
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
