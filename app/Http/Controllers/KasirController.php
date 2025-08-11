<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuatOrder;
use App\Models\TambahPelanggan;
use App\Models\Layanan; // Add this line to import the Layanan model

class KasirController extends Controller
{
    public function index()
    {
        $todayRevenue = BuatOrder::whereDate('created_at', today())->sum('total_harga');
        $todayOrders = BuatOrder::whereDate('created_at', today())->count();
        $monthOrders = BuatOrder::whereMonth('created_at', now()->month)->count();
        $newCustomers = TambahPelanggan::whereDate('created_at', today())->count();
        $totalServices = Layanan::count(); // Get the total count of services
        $totalOrders = BuatOrder::count(); // Get the total count of all orders
        $totalCustomers = TambahPelanggan::count(); // Get the total count of all customers

        return view('kasir.dashboard', compact('todayRevenue', 'todayOrders', 'monthOrders', 'newCustomers', 'totalServices', 'totalOrders', 'totalCustomers'));
    }
}