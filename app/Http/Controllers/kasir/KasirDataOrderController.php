<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuatOrder;
use Illuminate\Support\Facades\Auth;

class KasirDataOrderController extends Controller
{
    /**
     * Menampilkan daftar order sesuai cabang kasir.
     */
    public function index(Request $request)
    {
        // Ambil ID cabang dari kasir yang sedang login
        $cabangId = Auth::user()->cabang_id;

        // Mulai query dengan filter cabang terlebih dahulu
        $query = BuatOrder::with('pelanggan')->where('cabang_id', $cabangId);

        // Logika untuk fitur pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('pelanggan', function ($q2) use ($searchTerm) {
                    $q2->where('nama', 'like', '%' . $searchTerm . '%');
                })->orWhere('id', 'like', '%' . $searchTerm . '%');
            });
        }

        // Logika untuk fitur filter status
        if ($request->filled('status') && $request->status != 'Semua' && $request->status != 'Filter Status') {
            $query->where('status', $request->status);
        }

        // Pisahkan order yang belum selesai (menggunakan query yang sudah difilter)
        $orders = (clone $query)->where('status', '!=', 'Selesai')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10); // Menggunakan pagination
        
        // Pisahkan order yang sudah selesai (juga difilter berdasarkan cabang)
        $historyOrders = BuatOrder::with('pelanggan')
                                ->where('cabang_id', $cabangId)
                                ->where('status', 'Selesai')
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('kasir.data_order', compact('orders', 'historyOrders'));
    }

    /**
     * Update status order.
     */
    public function updateStatus(Request $request, BuatOrder $order)
    {
        // Pengecekan keamanan: Pastikan kasir hanya bisa mengubah order di cabangnya sendiri
        if ($order->cabang_id != Auth::user()->cabang_id) {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        $request->validate(['status' => 'required|in:Diproses,Sudah Bisa Diambil,Selesai']);

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status berhasil diubah!', 'order' => $order]);
    }
}