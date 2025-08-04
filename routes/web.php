<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;

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
Route::get('/pengguna', function () {
    return view('pengguna');
})->name('datauser');

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
Route::get('/produk', [ServiceController::class, 'index'])->name('produk');
Route::resource('layanan', ServiceController::class)->except(['index']);

// Route untuk kasir (saya lihat ada potongan kode yang tidak lengkap)
Route::get('/kasir/home', function () {
    return view('kasir/home');
})->name('kasir.home');

Route::get('/kasir/pelanggan', function () {
    return view('kasir/pelanggan');
})->name('kasir.pelanggan');