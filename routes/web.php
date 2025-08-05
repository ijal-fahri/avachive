<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LayananController;
// Halaman utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', function () {
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

// Logout (sebaiknya gunakan yang dari auth.php)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('status', 'Berhasil logout');
})->name('logout');

// Produk / Layanan: CRUD (pakai Controller)
Route::get('/produk', [LayananController::class, 'index'])->name('produk');
Route::post('/produk', [LayananController::class, 'store'])->name('produk.store');
Route::put('/produk/{id}', [LayananController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [LayananController::class, 'destroy'])->name('produk.destroy');



Route::get('/produk', [ServiceController::class, 'index'])->name('produk');
Route::resource('layanan', ServiceController::class)->except(['index']);

// Route untuk kasir (saya lihat ada potongan kode yang tidak lengkap)
Route::get('/kasir/home', function () {
    return view('kasir/home');
})->name('kasir.home');

Route::get('/kasir/pelanggan', function () {
    return view('kasir/pelanggan');
})->name('kasir.pelanggan');

Route::get('/kasir/buat_order', function () {
    return view('kasir/buat_order');
})->name('kasir.buat_order');

Route::get('/kasir/data_order', function () {
    return view('kasir/data_order');
})->name('kasir.data_order');

Route::get('/kasir/pengaturan', function () {
    return view('kasir/pengaturan');
})->name('kasir.pengaturan');