<?php

use Illuminate\Support\Facades\Route;

// ── Public Controllers ─────────────────────────────────────────────────────
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\ContactController;

// ── Admin Controllers ──────────────────────────────────────────────────────
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

// ╔══════════════════════════════════════════════════════════════════════════╗
// ║  PUBLIC ROUTES                                                           ║
// ╚══════════════════════════════════════════════════════════════════════════╝
// Fix: Laravel 13 auth redirect default ke 'login', kita arahkan ke admin.login
Route::get('/login', function() {
    return redirect()->route('admin.login');
})->name('login');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ╔══════════════════════════════════════════════════════════════════════════╗
// ║  ADMIN ROUTES                                                            ║
// ╚══════════════════════════════════════════════════════════════════════════╝

Route::prefix('admin')->name('admin.')->group(function () {

    // ── Auth (guests only) ─────────────────────────────────────────────────
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── Protected admin routes ─────────────────────────────────────────────
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Services CRUD
        Route::resource('services', AdminServiceController::class);

        // Gallery CRUD
        Route::resource('gallery', AdminGalleryController::class);

        // Contacts (view + status update + delete)
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::patch('/contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('contacts.status');
        Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    });
});
