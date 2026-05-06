@extends('layouts.app')

@section('title', 'Kontak')
@section('title_suffix', 'Hubungi Kami')

@section('content')

{{-- Header --}}
<section class="pt-28 pb-16 lg:pt-36 lg:pb-20 bg-white border-b border-stone-100">
    <div class="container-main">
        <div class="max-w-2xl">
            <span class="section-label">📬 Kontak Kami</span>
            <h1 class="heading-xl mt-4">
                Ada Pertanyaan?<br>
                <span class="text-brand-500 font-display italic">Kami Siap Membantu!</span>
            </h1>
            <p class="lead mt-6">
                Butuh rekomendasi buku, ada pertanyaan tentang konten, atau ingin bekerja sama? Jangan ragu untuk menghubungi kami.
            </p>
        </div>
    </div>
</section>

<section class="section bg-stone-50">
    <div class="container-main">
        <div class="grid lg:grid-cols-5 gap-12">

            {{-- Info --}}
            <div class="lg:col-span-2 space-y-6 animate-on-scroll">

                <div class="card p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                            @include('components.icon', ['name' => 'mail', 'class' => 'w-5 h-5 text-brand-600'])
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-1">Email</p>
                            <a href="mailto:info@maribelajarcoding.site"
                               class="text-stone-700 text-sm hover:text-brand-600 transition-colors">
                                info@maribelajarcoding.site
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                            @include('components.icon', ['name' => 'phone', 'class' => 'w-5 h-5 text-brand-600'])
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-1">WhatsApp</p>
                            <a href="https://wa.me/6281234567890"
                               class="text-stone-700 text-sm hover:text-brand-600 transition-colors">
                                +62 812 3456 7890
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                            @include('components.icon', ['name' => 'clock', 'class' => 'w-5 h-5 text-brand-600'])
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-1">Jam Layanan</p>
                            <p class="text-stone-700 text-sm">Senin – Jumat, 08:00 – 17:00 WIB</p>
                        </div>
                    </div>
                </div>

                <div class="card p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 flex items-center justify-center flex-shrink-0">
                            @include('components.icon', ['name' => 'location-marker', 'class' => 'w-5 h-5 text-brand-600'])
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-400 mb-1">Lokasi</p>
                            <p class="text-stone-700 text-sm">Jakarta, Indonesia</p>
                        </div>
                    </div>
                </div>

                {{-- Topics --}}
                <div class="card p-6">
                    <p class="text-sm font-semibold text-stone-800 mb-3">💬 Topik yang Sering Ditanyakan</p>
                    <ul class="space-y-2 text-sm text-stone-500">
                        <li>📚 Rekomendasi buku untuk pemula</li>
                        <li>🛒 Cara pemesanan & pengiriman</li>
                        <li>✍️ Kerjasama penulisan buku</li>
                        <li>🎓 Bulk order untuk institusi</li>
                        <li>📝 Request topik buku baru</li>
                    </ul>
                </div>
            </div>

            {{-- Form --}}
            <div class="lg:col-span-3 animate-on-scroll animation-delay-100">

                @if(session('success'))
                    <div class="card p-6 mb-6 border-green-100 bg-green-50">
                        <div class="flex items-start gap-3">
                            @include('components.icon', ['name' => 'check-circle', 'class' => 'w-6 h-6 text-green-500 flex-shrink-0 mt-0.5'])
                            <div>
                                <p class="font-semibold text-green-800">Pesan Terkirim! 🎉</p>
                                <p class="text-green-700 text-sm mt-1">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card p-8 lg:p-10">
                    <h2 class="font-display text-2xl font-semibold text-stone-900 mb-2">Kirim Pesan</h2>
                    <p class="text-stone-500 text-sm mb-8">Kami akan membalas dalam 1–2 hari kerja.</p>

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5" novalidate>
                        @csrf

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="form-label">
                                    Nama Lengkap <span class="text-red-400">*</span>
                                </label>
                                <input type="text" id="name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Nama kamu"
                                       class="form-input {{ $errors->has('name') ? 'border-red-300' : '' }}"
                                       required>
                                @error('name') <p class="form-error">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="form-label">
                                    Email <span class="text-red-400">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="email@kamu.com"
                                       class="form-input {{ $errors->has('email') ? 'border-red-300' : '' }}"
                                       required>
                                @error('email') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="form-label">Nomor WhatsApp</label>
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="+62 8xx xxxx xxxx"
                                       class="form-input">
                            </div>

                            <div>
                                <label for="subject" class="form-label">Perihal</label>
                                <select id="subject" name="subject" class="form-input">
                                    <option value="">Pilih topik...</option>
                                    <option value="Rekomendasi Buku" {{ old('subject') === 'Rekomendasi Buku' ? 'selected' : '' }}>Rekomendasi Buku</option>
                                    <option value="Pemesanan Buku" {{ old('subject') === 'Pemesanan Buku' ? 'selected' : '' }}>Pemesanan Buku</option>
                                    <option value="Kerjasama Penulisan" {{ old('subject') === 'Kerjasama Penulisan' ? 'selected' : '' }}>Kerjasama Penulisan</option>
                                    <option value="Bulk Order Institusi" {{ old('subject') === 'Bulk Order Institusi' ? 'selected' : '' }}>Bulk Order Institusi</option>
                                    <option value="Lainnya" {{ old('subject') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="form-label">
                                Pesan <span class="text-red-400">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6"
                                      placeholder="Ceritakan kebutuhan atau pertanyaan kamu..."
                                      class="form-input resize-none {{ $errors->has('message') ? 'border-red-300' : '' }}"
                                      required>{{ old('message') }}</textarea>
                            @error('message') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full justify-center py-3.5">
                            @include('components.icon', ['name' => 'mail', 'class' => 'w-5 h-5'])
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
