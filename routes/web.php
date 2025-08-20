<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- DAFTAR SEMUA CONTROLLER ANDA ---
// Auth & Roles
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DriverController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CabangController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\DataOrderController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Middleware\EnsureCabangIsSelected;

// Kasir Controllers
use App\Http\Controllers\kasir\KasirPelangganController;
use App\Http\Controllers\kasir\KasirBuatOrderController;
use App\Http\Controllers\kasir\KasirDataOrderController;
use App\Http\Controllers\kasir\KasirSettingsController;

// Driver Controllers
use App\Http\Controllers\driver\DriverPengaturanController;
use App\Http\Controllers\driver\DriverRiwayatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// Memanggil semua route untuk otentikasi (login, register, dll.)
require __DIR__.'/auth.php';


// --- SEMUA ROUTE YANG MEMBUTUHKAN LOGIN ---
Route::middleware('auth')->group(function () {

    // Profile Pengguna (bawaan Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    // --- GRUP ROUTE UNTUK ADMIN ---
    Route::middleware(['admin', EnsureCabangIsSelected::class])->prefix('admin')->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Fitur Cabang
        Route::get('/set-cabang/{cabang}', [DashboardController::class, 'setCabangAktif'])->name('admin.set_cabang');
        Route::resource('cabang', CabangController::class)->except(['index', 'create', 'edit']);

        // Fitur Order
        Route::get('/order', [DataOrderController::class, 'index'])->name('dataorder');
        Route::patch('/order/{order}/status', [DataOrderController::class, 'updateStatus'])->name('admin.order.updateStatus');

        // Fitur Layanan (Produk)
        Route::resource('produk', LayananController::class);

        // Fitur Pengguna (Karyawan)
        Route::resource('pengguna', PenggunaController::class)->names(['index' => 'datauser']);

        // Fitur Pengaturan
        Route::get('/pengaturan', function () { return view('pengaturan'); })->name('pengaturan');

        // Fitur Laporan
        Route::view('/laporan', 'admin.reporting')->name('laporan');
    });


    // --- GRUP ROUTE UNTUK KASIR ---
    Route::middleware('kasir')->prefix('kasir')->group(function () {
        Route::get('/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
        Route::resource('pelanggan', KasirPelangganController::class);
        Route::resource('buat_order', KasirBuatOrderController::class);
        Route::get('data_order', [KasirDataOrderController::class, 'index'])->name('kasir.data_order');
        Route::patch('data_order/{order}/status', [KasirDataOrderController::class, 'updateStatus'])->name('kasir.dataorder.update_status');
        Route::resource('pengaturan', KasirSettingsController::class);
    });


    // --- GRUP ROUTE UNTUK DRIVER ---
    Route::middleware('driver')->prefix('driver')->group(function () {
        Route::get('/dashboard', [DriverController::class, 'index'])->name('driver.dashboard');
        Route::resource('riwayat', DriverRiwayatController::class);
        Route::resource('pengaturan', DriverPengaturanController::class);
    });

});