@extends('layouts.admin')

@section('title', isset($gallery) ? 'Edit Foto' : 'Tambah Foto Galeri')
@section('breadcrumb', isset($gallery) ? 'Edit: ' . $gallery->title : 'Upload foto baru ke galeri')

@section('content')

<div class="max-w-2xl">

    <a href="{{ route('admin.gallery.index') }}"
       class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-stone-800 mb-6 transition-colors">
        @include('components.icon', ['name' => 'arrow-left', 'class' => 'w-4 h-4'])
        Kembali ke Galeri
    </a>

    <div class="card p-8">
        <form method="POST"
              action="{{ isset($gallery) ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            @if(isset($gallery)) @method('PUT') @endif

            {{-- Upload Foto --}}
            <div>
                <label class="form-label">
                    Foto {{ !isset($gallery) ? '*' : '' }}
                </label>

                @if(isset($gallery) && $gallery->image)
                    <div class="mb-3">
                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}"
                             class="w-full max-h-48 object-cover rounded-xl border border-stone-200">
                        <p class="text-xs text-stone-400 mt-1">Foto saat ini — upload baru untuk mengganti</p>
                    </div>
                @endif

                <div class="border-2 border-dashed border-stone-200 rounded-xl p-8 text-center hover:border-brand-300 transition-colors">
                    <input type="file" id="image" name="image" accept="image/*"
                           class="hidden" onchange="previewImage(this)">
                    <label for="image" class="cursor-pointer block">
                        <div id="preview-wrap" class="hidden mb-4">
                            <img id="preview-img" src="" alt="" class="max-h-40 mx-auto rounded-xl object-cover">
                        </div>
                        @include('components.icon', ['name' => 'photograph', 'class' => 'w-12 h-12 text-stone-300 mx-auto mb-2'])
                        <p class="text-sm font-medium text-stone-600">Klik untuk upload foto</p>
                        <p class="text-xs text-stone-400 mt-1">PNG, JPG, WEBP — maks. 4MB</p>
                    </label>
                </div>
                @error('image') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Judul --}}
            <div>
                <label for="title" class="form-label">Judul Foto <span class="text-red-400">*</span></label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $gallery->title ?? '') }}"
                       placeholder="contoh: Workshop Laravel Batch 5"
                       class="form-input {{ $errors->has('title') ? 'border-red-300' : '' }}"
                       required>
                @error('title') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            {{-- Kategori & Urutan --}}
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="category" class="form-label">Kategori <span class="text-red-400">*</span></label>
                    <input type="text" id="category" name="category"
                           value="{{ old('category', $gallery->category ?? '') }}"
                           placeholder="contoh: event, workshop, buku"
                           list="categories-list"
                           class="form-input {{ $errors->has('category') ? 'border-red-300' : '' }}"
                           required>
                    <datalist id="categories-list">
                        <option value="event">
                        <option value="workshop">
                        <option value="buku">
                        <option value="tim">
                        <option value="umum">
                    </datalist>
                    @error('category') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="sort_order" class="form-label">Urutan Tampil</label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                           value="{{ old('sort_order', $gallery->sort_order ?? 0) }}"
                           class="form-input">
                    <p class="text-xs text-stone-400 mt-1">Angka kecil = tampil lebih awal</p>
                </div>
            </div>

            {{-- Keterangan --}}
            <div>
                <label for="caption" class="form-label">Keterangan <span class="text-stone-400 font-normal">(opsional)</span></label>
                <textarea id="caption" name="caption" rows="2"
                          placeholder="Keterangan singkat untuk foto ini..."
                          class="form-input resize-none">{{ old('caption', $gallery->caption ?? '') }}</textarea>
            </div>

            {{-- Toggle Tampil --}}
            <div class="pt-1">
                <label class="flex items-center gap-3 cursor-pointer">
                    <div class="relative">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 rounded-full bg-stone-200 peer-checked:bg-brand-500 transition-colors duration-200"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform duration-200 peer-checked:translate-x-4"></div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-stone-700">Tampilkan di Galeri</p>
                        <p class="text-xs text-stone-400">Nonaktifkan untuk menyembunyikan foto</p>
                    </div>
                </label>
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-3 pt-4 border-t border-stone-100">
                <button type="submit" class="btn-primary">
                    @include('components.icon', ['name' => 'check-circle', 'class' => 'w-4 h-4'])
                    {{ isset($gallery) ? 'Simpan Perubahan' : 'Tambah ke Galeri' }}
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="btn-secondary">Batal</a>
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
            document.getElementById('preview-wrap').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
