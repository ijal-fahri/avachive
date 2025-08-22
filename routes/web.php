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
use App\Http\Controllers\kasir\KasirRiwayatOrderController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DataOrderController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\driver\DriverPengaturanController;
use App\Http\Controllers\driver\DriverRiwayatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//role
Route::get('/admin/dashboard',[AdminController::class, 'index'])->middleware('auth','admin')->name('admin.dashboard');
Route::get('/kasir/dashboard',[KasirController::class, 'index'])->middleware('auth','kasir');
Route::get('/driver/dashboard',[DriverController::class, 'index'])->middleware('auth','driver');

// Kasir
Route::resource('/kasir/pelanggan', KasirPelangganController::class);
Route::resource('/kasir/buat_order', KasirBuatOrderController::class);
// Route::resource('/kasir/data_order', KasirDataOrderController::class);
Route::resource('/kasir/pengaturan', KasirSettingsController::class);
Route::get('/kasir/data_order', [KasirDataOrderController::class, 'index'])->middleware('auth','kasir')->name('kasir.dataorder.index');
Route::patch('/kasir/data_order/{order}/status', [KasirDataOrderController::class, 'updateStatus'])->middleware('auth','kasir')->name('kasir.dataorder.update_status');
Route::get('/kasir/riwayat_order', [KasirRiwayatOrderController::class, 'index'])->name('kasir.riwayatorder.index');


//Driver
Route::resource('/driver/riwayat', DriverRiwayatController::class);
Route::resource('/driver/pengaturan', DriverPengaturanController::class);

require __DIR__.'/auth.php';

Route::get('/home', function () {
    return view('welcome');
})->name('home');

// Dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
Route::resource('produk', LayananController::class);
