@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumb', 'Ringkasan & Statistik')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php
    $statCards = [
        ['label' => 'Total Buku',      'value' => $stats['services'],       'icon' => 'book',       'color' => 'brand'],
        ['label' => 'Item Galeri',     'value' => $stats['gallery'],         'icon' => 'photograph', 'color' => 'blue'],
        ['label' => 'Total Pesan',     'value' => $stats['contacts'],        'icon' => 'mail',       'color' => 'violet'],
        ['label' => 'Pesan Belum Dibaca','value' => $stats['unread_contacts'],'icon' => 'eye',       'color' => 'amber'],
    ];
    $colors = [
        'brand'  => ['bg' => 'bg-brand-50',  'icon' => 'text-brand-500'],
        'blue'   => ['bg' => 'bg-blue-50',   'icon' => 'text-blue-500'],
        'violet' => ['bg' => 'bg-violet-50', 'icon' => 'text-violet-500'],
        'amber'  => ['bg' => 'bg-amber-50',  'icon' => 'text-amber-500'],
    ];
    @endphp

    @foreach($statCards as $card)
        @php $c = $colors[$card['color']]; @endphp
        <div class="card p-6">
            <div class="w-10 h-10 rounded-xl {{ $c['bg'] }} flex items-center justify-center mb-4">
                @include('components.icon', ['name' => $card['icon'], 'class' => 'w-5 h-5 ' . $c['icon']])
            </div>
            <p class="text-2xl font-bold text-stone-900">{{ $card['value'] }}</p>
            <p class="text-xs text-stone-500 font-medium mt-1">{{ $card['label'] }}</p>
        </div>
    @endforeach
</div>

{{-- Aksi Cepat + Pesan Terbaru --}}
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Aksi Cepat --}}
    <div class="card p-6">
        <h2 class="font-semibold text-stone-900 text-sm mb-4">⚡ Aksi Cepat</h2>
        <div class="space-y-2">
            <a href="{{ route('admin.services.create') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-brand-50 text-stone-700 hover:text-brand-700 transition-all text-sm font-medium group">
                @include('components.icon', ['name' => 'plus', 'class' => 'w-5 h-5 text-stone-400 group-hover:text-brand-500'])
                Tambah Buku Baru
            </a>
            <a href="{{ route('admin.gallery.create') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-brand-50 text-stone-700 hover:text-brand-700 transition-all text-sm font-medium group">
                @include('components.icon', ['name' => 'plus', 'class' => 'w-5 h-5 text-stone-400 group-hover:text-brand-500'])
                Tambah Foto Galeri
            </a>
            <a href="{{ route('admin.contacts.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-brand-50 text-stone-700 hover:text-brand-700 transition-all text-sm font-medium group">
                @include('components.icon', ['name' => 'mail', 'class' => 'w-5 h-5 text-stone-400 group-hover:text-brand-500'])
                Lihat Pesan Masuk
                @if($stats['unread_contacts'] > 0)
                    <span class="ml-auto text-[11px] bg-red-500 text-white font-bold rounded-full px-1.5 py-0.5">
                        {{ $stats['unread_contacts'] }}
                    </span>
                @endif
            </a>
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-stone-50 text-stone-700 transition-all text-sm font-medium group">
                @include('components.icon', ['name' => 'external-link', 'class' => 'w-5 h-5 text-stone-400'])
                Lihat Website
            </a>
        </div>
    </div>

    {{-- Pesan Terbaru --}}
    <div class="lg:col-span-2 card p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-semibold text-stone-900 text-sm">📬 Pesan Terbaru</h2>
            <a href="{{ route('admin.contacts.index') }}" class="text-xs text-brand-600 hover:underline">Lihat semua</a>
        </div>

        @if($recentContacts->isEmpty())
            <div class="text-center py-10 text-stone-400">
                <p class="text-sm">Belum ada pesan masuk.</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($recentContacts as $contact)
                    <a href="{{ route('admin.contacts.show', $contact) }}"
                       class="flex items-start gap-3 p-3 rounded-xl hover:bg-stone-50 transition-colors group">
                        <div class="w-9 h-9 rounded-full bg-brand-100 flex items-center justify-center
                                    text-brand-700 font-semibold text-sm flex-shrink-0">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-stone-800 truncate">{{ $contact->name }}</p>
                                @if($contact->status === 'unread')
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 flex-shrink-0"></span>
                                @endif
                            </div>
                            <p class="text-xs text-stone-500 truncate">
                                {{ $contact->subject ?? Str::limit($contact->message, 60) }}
                            </p>
                        </div>
                        <span class="text-[11px] text-stone-400 flex-shrink-0">
                            {{ $contact->created_at->diffForHumans() }}
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
