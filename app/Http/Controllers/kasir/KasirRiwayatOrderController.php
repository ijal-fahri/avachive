<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuatOrder; // tambahkan model
use App\Models\TambahPelanggan; // jika butuh relasi pelanggan

class KasirRiwayatOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BuatOrder::with('pelanggan')
            ->where('status', 'Selesai')
            ->orderBy('created_at', 'desc');

        // Fitur pencarian jika dibutuhkan
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->whereHas('pelanggan', function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%');
            })->orWhere('id', 'like', '%' . $searchTerm . '%');
        }

        $historyOrders = $query->get();

        return view('kasir.riwayat_order', compact('historyOrders'));
    }
}
