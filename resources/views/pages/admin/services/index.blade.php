@extends('layouts.admin')

@section('title', 'Katalog Buku')
@section('breadcrumb', 'Kelola Daftar Buku')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-sm text-stone-500">Total {{ $services->total() }} buku</h2>
    <a href="{{ route('admin.services.create') }}" class="btn-primary text-sm py-2.5">
        @include('components.icon', ['name' => 'plus', 'class' => 'w-4 h-4'])
        Tambah Buku
    </a>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-stone-100 bg-stone-50">
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400">Judul Buku</th>
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400 hidden md:table-cell">Urutan</th>
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400 hidden lg:table-cell">Unggulan</th>
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400">Status</th>
                    <th class="text-right px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-50">
                @forelse($services as $service)
                    <tr class="hover:bg-stone-50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                                    @include('components.icon', ['name' => 'book', 'class' => 'w-4 h-4 text-brand-600'])
                                </div>
                                <div>
                                    <p class="font-medium text-stone-800">{{ $service->title }}</p>
                                    <p class="text-xs text-stone-400 truncate max-w-[220px]">{{ $service->excerpt }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="text-stone-500 font-mono text-xs">{{ $service->sort_order }}</span>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            @if($service->is_featured)
                                <span class="badge badge-success">⭐ Ya</span>
                            @else
                                <span class="badge bg-stone-100 text-stone-500 border border-stone-200">Tidak</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($service->is_active)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge bg-stone-100 text-stone-500 border border-stone-200">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('services.show', $service->slug) }}" target="_blank"
                                   class="p-1.5 rounded-lg text-stone-400 hover:text-stone-700 hover:bg-stone-100 transition-all" title="Lihat">
                                    @include('components.icon', ['name' => 'eye', 'class' => 'w-4 h-4'])
                                </a>
                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="p-1.5 rounded-lg text-stone-400 hover:text-brand-600 hover:bg-brand-50 transition-all" title="Edit">
                                    @include('components.icon', ['name' => 'pencil', 'class' => 'w-4 h-4'])
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="p-1.5 rounded-lg text-stone-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                        @include('components.icon', ['name' => 'trash', 'class' => 'w-4 h-4'])
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <p class="text-4xl mb-3">📚</p>
                            <p class="text-stone-500 font-medium">Belum ada buku.</p>
                            <a href="{{ route('admin.services.create') }}" class="btn-primary mt-4 text-sm py-2">
                                Tambah Buku Pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($services->hasPages())
        <div class="px-6 py-4 border-t border-stone-100">
            {{ $services->links() }}
        </div>
    @endif
</div>

@endsection
