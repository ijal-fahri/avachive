<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;

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
Route::get('/pengguna', function () {
    return view('pengguna');
})->name('datauser');

// Pengaturan
Route::get('/pengaturan', function () {
    return view('pengaturan');
})->name('pengaturan');

// Logout (dummy)
Route::post('/logout', function () {
    return redirect('/')->with('status', 'Berhasil logout');
})->name('logout');

// Produk / Layanan: CRUD (pakai Controller)
Route::get('/produk', [ServiceController::class, 'index'])->name('produk');
Route::resource('/layanan', ServiceController::class)->except(['index']);
