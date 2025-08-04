<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LayananController;
// Halaman utama (landing page)
Route::get('/', function () {

    return view('welcome');
})->name('home');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Order
Route::get('/order', function () {
    return view('order');
})->name('dataorder');

// Pengguna
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('datauser');
Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

// Pengaturan
Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

// Logout (dummy)
Route::post('/logout', function () {
    return redirect('/')->with('status', 'Berhasil logout');
})->name('logout');

// Produk / Layanan: CRUD (pakai Controller)
Route::get('/produk', [LayananController::class, 'index'])->name('produk');
Route::post('/produk', [LayananController::class, 'store'])->name('produk.store');
Route::put('/produk/{id}', [LayananController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [LayananController::class, 'destroy'])->name('produk.destroy');
    return view('kasir/home');


