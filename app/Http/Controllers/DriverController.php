<?php

namespace App\Http\Controllers;
use App\Models\BuatOrder;
use App\Models\TambahPelanggan;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
{
    $orders = BuatOrder::with('pelanggan')
        ->where('metode_pengambilan', 'Diantar')
        ->where('status', 'Sudah Bisa Diambil')
        ->get();

    return view('driver.dashboard', compact('orders'));
}

}
