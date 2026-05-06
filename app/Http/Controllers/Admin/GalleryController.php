<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->paginate(20);
        return view('pages.admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('pages.admin.gallery.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateGallery($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function edit(Gallery $gallery)
    {
        return view('pages.admin.gallery.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $this->validateGallery($request, update: true);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil dihapus dari galeri.');
    }

    private function validateGallery(Request $request, bool $update = false): array
    {
        return $request->validate([
            'title'      => ['required', 'string', 'max:150'],
            'category'   => ['required', 'string', 'max:50'],
            'caption'    => ['nullable', 'string', 'max:300'],
            'image'      => [$update ? 'nullable' : 'required', 'image', 'max:4096'],
            'sort_order' => ['integer', 'min:0'],
            'is_active'  => ['boolean'],
        ]);
    }
}
