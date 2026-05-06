<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries   = Gallery::active()->get();
        $categories  = Gallery::getCategories();

        return view('public.gallery', compact('galleries', 'categories'));
    }
}
