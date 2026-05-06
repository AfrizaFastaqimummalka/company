@extends('layouts.admin')

@section('title', 'Galeri')
@section('breadcrumb', 'Kelola Foto Galeri')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-sm text-stone-500">Total {{ $galleries->total() }} foto</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary text-sm py-2.5">
        @include('components.icon', ['name' => 'plus', 'class' => 'w-4 h-4'])
        Tambah Foto
    </a>
</div>

@if($galleries->isNotEmpty())
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
        @foreach($galleries as $item)
            <div class="card overflow-hidden group">
                <div class="relative aspect-video bg-stone-100">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                    <div class="absolute inset-0 bg-stone-900/50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center gap-2">
                        <a href="{{ route('admin.gallery.edit', $item) }}"
                           class="w-8 h-8 rounded-full bg-white/90 flex items-center justify-center text-stone-700 hover:bg-white transition-colors">
                            @include('components.icon', ['name' => 'pencil', 'class' => 'w-4 h-4'])
                        </a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}"
                              onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-8 h-8 rounded-full bg-white/90 flex items-center justify-center text-red-600 hover:bg-white transition-colors">
                                @include('components.icon', ['name' => 'trash', 'class' => 'w-4 h-4'])
                            </button>
                        </form>
                    </div>

                    @if(!$item->is_active)
                        <span class="absolute top-2 left-2 text-[10px] bg-stone-800/80 text-white rounded-full px-2 py-0.5 font-medium">
                            Disembunyikan
                        </span>
                    @endif
                </div>

                <div class="p-3">
                    <p class="text-sm font-medium text-stone-800 truncate">{{ $item->title }}</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-[11px] text-stone-400 capitalize">{{ $item->category }}</span>
                        <span class="text-[11px] text-stone-400">#{{ $item->sort_order }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($galleries->hasPages())
        {{ $galleries->links() }}
    @endif
@else
    <div class="card p-16 text-center">
        <p class="text-4xl mb-4">🖼️</p>
        <p class="text-stone-500 font-medium">Belum ada foto di galeri.</p>
        <a href="{{ route('admin.gallery.create') }}" class="btn-primary mt-4 text-sm py-2">
            Tambah Foto Pertama
        </a>
    </div>
@endif

@endsection
