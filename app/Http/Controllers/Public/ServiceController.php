<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();

        return view('public.services', compact('services'));
    }

    public function show(string $slug)
    {
        $service  = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related  = Service::active()->where('id', '!=', $service->id)->limit(3)->get();

        return view('public.service-detail', compact('service', 'related'));
    }
}
