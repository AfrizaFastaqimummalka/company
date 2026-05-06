@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Buku' : 'Tambah Buku Baru')
@section('breadcrumb', isset($service) ? 'Edit: ' . $service->title : 'Tambahkan buku ke katalog')

@section('content')

<div class="max-w-3xl">

    <a href="{{ route('admin.services.index') }}"
       class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-stone-800 mb-6 transition-colors">
        @include('components.icon', ['name' => 'arrow-left', 'class' => 'w-4 h-4'])
        Kembali ke Katalog Buku
    </a>

    <div class="card p-8">
        <form method="POST"
              action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @if(isset($service)) @method('PUT') @endif

            {{-- Judul --}}
            <div>
                <label for="title" class="form-label">
                    Judul Buku <span class="text-red-400">*</span>
                </label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $service->title ?? '') }}"
                       placeholder="contoh: Belajar Laravel dari Nol"
                       class="form-input {{ $errors->has('title') ? 'border-red-300' : '' }}"
                       required>
                @error('title') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi Singkat --}}
            <div>
                <label for="excerpt" class="form-label">
                    Deskripsi Singkat <span class="text-red-400">*</span>
                    <span class="text-stone-400 font-normal">(maks. 300 karakter)</span>
                </label>
                <textarea id="excerpt" name="excerpt" rows="2" maxlength="300"
                          placeholder="Deskripsi singkat yang tampil di kartu buku..."
                          class="form-input resize-none {{ $errors->has('excerpt') ? 'border-red-300' : '' }}"
                          required>{{ old('excerpt', $service->excerpt ?? '') }}</textarea>
                @error('excerpt') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi Lengkap --}}
            <div>
                <label for="description" class="form-label">
                    Deskripsi Lengkap
                    <span class="text-stone-400 font-normal">(tampil di halaman detail buku)</span>
                </label>
                <textarea id="description" name="description" rows="6"
                          placeholder="Penjelasan lengkap isi buku, materi yang dibahas, dll..."
                          class="form-input {{ $errors->has('description') ? 'border-red-300' : '' }}">{{ old('description', $service->description ?? '') }}</textarea>
                @error('description') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Icon & Urutan --}}
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label for="icon" class="form-label">Ikon <span class="text-red-400">*</span></label>
                    <select id="icon" name="icon" class="form-input">
                        @foreach($icons as $iconName)
                            <option value="{{ $iconName }}"
                                    {{ old('icon', $service->icon ?? 'book') === $iconName ? 'selected' : '' }}>
                                {{ ucwords(str_replace('-', ' ', $iconName)) }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-stone-400 mt-1">Pilih "book" untuk ikon buku 📖</p>
                </div>

                <div>
                    <label for="sort_order" class="form-label">Urutan Tampil</label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                           value="{{ old('sort_order', $service->sort_order ?? 0) }}"
                           class="form-input">
                    <p class="text-xs text-stone-400 mt-1">Angka kecil = tampil lebih awal</p>
                </div>
            </div>

            {{-- Upload Gambar --}}
            <div>
                <label class="form-label">Gambar Cover Buku</label>

                @if(isset($service) && $service->image)
                    <div class="mb-3 relative inline-block">
                        <img src="{{ asset('storage/' . $service->image) }}"
                             alt="Cover saat ini"
                             class="w-32 h-20 object-cover rounded-xl border border-stone-200">
                        <span class="absolute -top-1.5 -right-1.5 text-[10px] bg-stone-700 text-white rounded-full px-1.5 py-0.5">Saat ini</span>
                    </div>
                @endif

                <div class="border-2 border-dashed border-stone-200 rounded-xl p-6 text-center hover:border-brand-300 transition-colors">
                    <input type="file" id="image" name="image" accept="image/*"
                           class="hidden" onchange="previewImage(this)">
                    <label for="image" class="cursor-pointer">
                        <div id="image-preview" class="hidden mb-3">
                            <img id="preview-img" src="" alt="Preview" class="w-32 h-20 object-cover rounded-xl mx-auto">
                        </div>
                        @include('components.icon', ['name' => 'photograph', 'class' => 'w-10 h-10 text-stone-300 mx-auto mb-2'])
                        <p class="text-sm text-stone-500">Klik untuk upload gambar cover</p>
                        <p class="text-xs text-stone-400 mt-1">PNG, JPG maksimal 2MB</p>
                    </label>
                </div>
                @error('image') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Toggle --}}
            <div class="grid sm:grid-cols-2 gap-6 pt-2">
                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $service->is_featured ?? false) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 rounded-full bg-stone-200 peer-checked:bg-brand-500 transition-colors duration-200"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform duration-200 peer-checked:translate-x-4"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-stone-700">Buku Unggulan ⭐</p>
                        <p class="text-xs text-stone-400">Tampil di halaman utama</p>
                    </div>
                </label>

                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 rounded-full bg-stone-200 peer-checked:bg-brand-500 transition-colors duration-200"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform duration-200 peer-checked:translate-x-4"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-stone-700">Aktif / Tampil</p>
                        <p class="text-xs text-stone-400">Buku terlihat di website</p>
                    </div>
                </label>
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-3 pt-4 border-t border-stone-100">
                <button type="submit" class="btn-primary">
                    @include('components.icon', ['name' => 'check-circle', 'class' => 'w-4 h-4'])
                    {{ isset($service) ? 'Simpan Perubahan' : 'Tambah Buku' }}
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
