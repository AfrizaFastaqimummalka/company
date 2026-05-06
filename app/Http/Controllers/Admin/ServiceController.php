<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(15);
        return view('pages.admin.services.index', compact('services'));
    }

    public function create()
    {
        $icons = $this->getIconList();
        return view('pages.admin.services.form', compact('icons'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Buku berhasil ditambahkan ke katalog.');
    }

    public function edit(Service $service)
    {
        $icons = $this->getIconList();
        return view('pages.admin.services.form', compact('service', 'icons'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Perubahan buku berhasil disimpan.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Buku berhasil dihapus dari katalog.');
    }

    private function validateService(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'excerpt'     => ['required', 'string', 'max:300'],
            'description' => ['nullable', 'string'],
            'icon'        => ['required', 'string', 'max:50'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
            'is_active'   => ['boolean'],
        ]);
    }

    private function getIconList(): array
    {
        return [
            'book', 'chart-bar', 'device-mobile', 'clipboard-list', 'search',
            'sparkles', 'academic-cap', 'briefcase', 'cog', 'globe',
            'light-bulb', 'shield-check', 'users', 'star', 'trending-up',
            'database', 'code', 'cloud', 'lock-closed', 'mail', 'phone',
        ];
    }
}
