@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('breadcrumb', 'Dari: ' . $contact->name)

@section('content')

<div class="max-w-3xl">

    <a href="{{ route('admin.contacts.index') }}"
       class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-stone-800 mb-6 transition-colors">
        @include('components.icon', ['name' => 'arrow-left', 'class' => 'w-4 h-4'])
        Kembali ke Pesan Masuk
    </a>

    <div class="grid gap-6">

        {{-- Detail Pesan --}}
        <div class="card p-8">
            <div class="flex items-start justify-between mb-6 pb-6 border-b border-stone-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-100 flex items-center justify-center text-brand-700 font-bold text-lg">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="font-semibold text-stone-900 text-lg">{{ $contact->name }}</h2>
                        <div class="flex items-center gap-3 mt-1">
                            <a href="mailto:{{ $contact->email }}" class="text-sm text-brand-600 hover:underline">
                                {{ $contact->email }}
                            </a>
                            @if($contact->phone)
                                <span class="text-stone-300">·</span>
                                <a href="tel:{{ $contact->phone }}" class="text-sm text-stone-500 hover:text-stone-700">
                                    {{ $contact->phone }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @if($contact->status === 'unread')
                    <span class="badge badge-warning">Belum Dibaca</span>
                @elseif($contact->status === 'read')
                    <span class="badge badge-info">Sudah Dibaca</span>
                @else
                    <span class="badge badge-success">Sudah Dibalas</span>
                @endif
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mb-6 text-sm">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-1">Perihal</p>
                    <p class="text-stone-700">{{ $contact->subject ?: '(Tidak ada perihal)' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-1">Diterima</p>
                    <p class="text-stone-700">
                        {{ $contact->created_at->format('d F Y, H:i') }} WIB
                        <span class="text-stone-400">({{ $contact->created_at->diffForHumans() }})</span>
                    </p>
                </div>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-3">Isi Pesan</p>
                <div class="bg-stone-50 rounded-xl p-6 text-stone-700 leading-relaxed whitespace-pre-wrap text-sm border border-stone-100">
                    {{ $contact->message }}
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-stone-100">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                   class="btn-primary text-sm">
                    @include('components.icon', ['name' => 'mail', 'class' => 'w-4 h-4'])
                    Balas via Email
                </a>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="card p-6">
            <h3 class="font-semibold text-stone-900 mb-4">🔄 Perbarui Status</h3>

            <form method="POST" action="{{ route('admin.contacts.status', $contact) }}" class="space-y-4">
                @csrf @method('PATCH')

                <div>
                    <label class="form-label">Status Pesan</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach(['unread' => 'Belum Dibaca', 'read' => 'Sudah Dibaca', 'replied' => 'Sudah Dibalas'] as $value => $label)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="{{ $value }}"
                                       {{ $contact->status === $value ? 'checked' : '' }}
                                       class="text-brand-500 focus:ring-brand-400">
                                <span class="text-sm text-stone-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label for="admin_notes" class="form-label">Catatan Internal</label>
                    <textarea id="admin_notes" name="admin_notes" rows="3"
                              placeholder="Catatan khusus (hanya terlihat oleh admin)..."
                              class="form-input resize-none text-sm">{{ $contact->admin_notes }}</textarea>
                </div>

                <button type="submit" class="btn-primary text-sm py-2.5">
                    @include('components.icon', ['name' => 'check-circle', 'class' => 'w-4 h-4'])
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Hapus --}}
        <div class="card p-6 border-red-100">
            <h3 class="font-semibold text-stone-900 mb-1">Hapus Pesan</h3>
            <p class="text-stone-500 text-sm mb-4">Pesan yang dihapus tidak bisa dikembalikan.</p>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                  onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 border border-red-200 rounded-xl hover:bg-red-50 transition-colors">
                    @include('components.icon', ['name' => 'trash', 'class' => 'w-4 h-4'])
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
