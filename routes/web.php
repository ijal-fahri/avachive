<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\kasir\KasirPelangganController;
use App\Http\Controllers\kasir\KasirBuatOrderController;
use App\Http\Controllers\kasir\KasirDataOrderController;
use App\Http\Controllers\kasir\KasirSettingsController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DataOrderController; 

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

//role
Route::get('/admin/dashboard',[AdminController::class, 'index'])->middleware('auth','admin');
Route::get('/kasir/dashboard',[KasirController::class, 'index'])->middleware('auth','kasir');
Route::get('/driver/dashboard',[DriverController::class, 'index'])->middleware('auth','driver');

// Kasir
Route::resource('/kasir/pelanggan', KasirPelangganController::class);
Route::resource('/kasir/buat_order', KasirBuatOrderController::class);
Route::resource('/kasir/data_order', KasirDataOrderController::class);
Route::resource('/kasir/pengaturan', KasirSettingsController::class);



//admin



require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('welcome');
})->name('home');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Order
Route::get('order', [DataOrderController::class, 'index'])->name('dataorder');

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
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Produk / Layanan: CRUD (pakai Controller)
Route::get('/produk', [LayananController::class, 'index'])->name('produk');
Route::post('/produk', [LayananController::class, 'store'])->name('produk.store');
Route::put('/produk/{id}', [LayananController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [LayananController::class, 'destroy'])->name('produk.destroy');

