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
            ->where('status', 'Selesai'); // Selalu filter status Selesai

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pelanggan', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_handphone', 'like', "%{$search}%");
            });
        }

        $historyOrders = $query->paginate(10);

        return view('kasir.riwayat_order', compact('historyOrders'));
    }
}