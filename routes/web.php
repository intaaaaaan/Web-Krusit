<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ApiCrudController;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Additional views
Route::get('/kontak', function () {
    return view('kontak');
})->middleware(['auth', 'verified'])->name('kontak');

Route::get('/menu', function () {
    return view('menu');
})->middleware(['auth', 'verified'])->name('menu');

// Barang routes
Route::resource('barang', BarangController::class)->middleware('auth');
Route::get('/makanan', [BarangController::class, 'showMakanan'])->name('makanan');
Route::get('/minuman', [BarangController::class, 'showMinuman'])->name('minuman');

// Pemesanan routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/makanan/store', [PemesananController::class, 'store'])->name('pesan.makanan2.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pesanan.approve');
});

// Api Management

Route::prefix('api-management')->name('api-mgmt.')->group(function () {
    Route::get('/{slug}',              [ApiCrudController::class, 'page'])->name('page');      // halaman CRUD
    Route::get('/{slug}/data',         [ApiCrudController::class, 'index'])->name('index');    // READ
    Route::post('/{slug}/data',        [ApiCrudController::class, 'store'])->name('store');    // CREATE
    Route::put('/{slug}/data/{id}',    [ApiCrudController::class, 'update'])->name('update');  // UPDATE
    Route::delete('/{slug}/data/{id}', [ApiCrudController::class, 'destroy'])->name('destroy');// DELETE
});


// Profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    Route::post('/makanan', [PemesananController::class, 'store'])->name('pesan.makanan.store');
    Route::post('/minuman', [PemesananController::class, 'store'])->name('pesan.minuman.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/aprove', [PemesananController::class, 'approve'])->name('pesanan.aprove');


});

// Authentication routes
require __DIR__.'/auth.php';
