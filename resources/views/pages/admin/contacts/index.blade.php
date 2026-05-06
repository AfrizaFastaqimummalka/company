@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('breadcrumb', 'Pesan dari Form Kontak')

@section('content')

{{-- Filter --}}
<div class="flex flex-col sm:flex-row gap-3 mb-6">
    <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex flex-1 gap-3">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari nama, email, atau subjek..."
               class="form-input flex-1 py-2.5 text-sm">

        <select name="status" class="form-input w-40 py-2.5 text-sm">
            <option value="">Semua Status</option>
            <option value="unread"  {{ request('status') === 'unread'  ? 'selected' : '' }}>Belum Dibaca</option>
            <option value="read"    {{ request('status') === 'read'    ? 'selected' : '' }}>Sudah Dibaca</option>
            <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
        </select>

        <button type="submit" class="btn-primary text-sm py-2.5">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.contacts.index') }}" class="btn-secondary text-sm py-2.5">Reset</a>
        @endif
    </form>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-stone-100 bg-stone-50">
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400">Pengirim</th>
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400 hidden md:table-cell">Perihal</th>
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400 hidden lg:table-cell">Diterima</th>
                    <th class="text-left px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400">Status</th>
                    <th class="text-right px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-stone-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-50">
                @forelse($contacts as $contact)
                    <tr class="hover:bg-stone-50 transition-colors group {{ $contact->status === 'unread' ? 'bg-blue-50/30' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center
                                            text-brand-700 font-semibold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-medium text-stone-800">{{ $contact->name }}</p>
                                        @if($contact->status === 'unread')
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 flex-shrink-0"></span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-stone-400">{{ $contact->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <p class="text-stone-600 truncate max-w-[200px]">
                                {{ $contact->subject ?? Str::limit($contact->message, 50) }}
                            </p>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <span class="text-stone-500">{{ $contact->created_at->format('d M Y') }}</span>
                            <p class="text-xs text-stone-400">{{ $contact->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($contact->status === 'unread')
                                <span class="badge badge-warning">Belum Dibaca</span>
                            @elseif($contact->status === 'read')
                                <span class="badge badge-info">Sudah Dibaca</span>
                            @else
                                <span class="badge badge-success">Sudah Dibalas</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.contacts.show', $contact) }}"
                                   class="p-1.5 rounded-lg text-stone-400 hover:text-brand-600 hover:bg-brand-50 transition-all">
                                    @include('components.icon', ['name' => 'eye', 'class' => 'w-4 h-4'])
                                </a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                      onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="p-1.5 rounded-lg text-stone-400 hover:text-red-600 hover:bg-red-50 transition-all">
                                        @include('components.icon', ['name' => 'trash', 'class' => 'w-4 h-4'])
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <p class="text-4xl mb-3">📭</p>
                            <p class="text-stone-500 font-medium">Belum ada pesan masuk.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($contacts->hasPages())
        <div class="px-6 py-4 border-t border-stone-100">
            {{ $contacts->links() }}
        </div>
    @endif
</div>

@endsection
