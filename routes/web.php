<?php

use App\Http\Controllers\Firebase\BeritaController;
use App\Http\Controllers\Firebase\IndexController;
use App\Http\Controllers\Firebase\KatalogController;
use App\Http\Controllers\Firebase\LoginController;
use App\Http\Controllers\Firebase\PasarController;
use App\Http\Controllers\Firebase\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', [UserController::class, 'index']);

Route::get('/masuk', function () {
    return view('pages.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('masuk');
Route::post('/logout', [LoginController::class, 'logout'])->name('keluar');

Route::get('/motif/{id}', [KatalogController::class, 'show'])->name('motif-show');

Route::fallback(function () {
    return response()->view('pages.404', [], 404);
});

Route::get('/gomaps-script', function() {
    $apiKey = env('GOMAPS_KEY');
    return response()->json([
        'script_url' => "https://maps.gomaps.pro/maps/api/js?key={$apiKey}&libraries=geometry,places&callback=initMap"
    ]);
});

Route::get('/api-key', function () {
    return response()->json([
        'api_key' => env('GOMAPS_KEY')
    ]);
});

Route::get('/api-key-update', function () {
    return response()->json([
        'api_key' => env('GOMAPS_KEY')
    ]);
});



Route::middleware(['admin'])->group(function () {
    // Beranda
    Route::get('/home',[IndexController::class, 'dashboard'])->name('dashboard');

    // Katalog Section
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
    Route::get('/tambah-motif', [KatalogController::class, 'create'])->name('tambah-motif');
    Route::post('/simpan-motif', [KatalogController::class, 'store'])->name('simpan-motif');
    Route::get('/edit-motif/{id}', [KatalogController::class, 'edit'])->name('edit-motif');
    Route::put('/update-motif/{id}', [KatalogController::class, 'update'])->name('update-motif');
    Route::delete('/hapus-motif/{id}', [KatalogController::class, 'destroy'])->name('destroy-motif');
    Route::get('/download-data-katalog', [KatalogController::class, 'downloadDataKatalog'])->name('download-data-katalog');

    // Berita Section
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/tambah-berita', [BeritaController::class, 'create'])->name('tambah-berita');
    Route::post('/simpan-berita', [BeritaController::class, 'store'])->name('simpan-berita');
    Route::get('/edit-berita/{id}', [BeritaController::class, 'edit'])->name('edit-berita');
    Route::put('/update-berita/{id}', [BeritaController::class, 'update'])->name('update-berita');
    Route::delete('/hapus-berita/{id}', [BeritaController::class, 'destroy'])->name('destroy-berita');
    Route::get('/download-data-berita', [BeritaController::class, 'downloadDataBerita'])->name('download-data-berita');

    // FAQ Section
    Route::get('/faq', function () {
        return view('pages.faq');
    });

    // Generate QR Section
    Route::get('/qr-motif', function () {
        return view('pages.generated-qr');
    });

    // Pasar Section
    Route::get('/ka-pasar', [PasarController::class, 'index'])->name('ka-pasar');
    Route::get('/tambah-toko', [PasarController::class, 'create'])->name('tambah-toko');
    Route::post('/simpan-toko', [PasarController::class, 'store'])->name('simpan-toko');
    Route::get('/edit-toko/{id}', [PasarController::class, 'edit'])->name('edit-toko');
    Route::put('/update-toko/{id}', [PasarController::class, 'update'])->name('update-toko');
    Route::delete('/hapus-toko/{id}', [PasarController::class, 'destroy'])->name('destroy-toko');
    Route::get('/download-data-pasar', [PasarController::class, 'downloadDataPasar'])->name('download-data-pasar');

    // Beranda Aplikasi Section
    Route::get('/aplikasi', function () {
        return view('pages.beranda-apk');
    });
});