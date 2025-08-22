<?php

// file: KasirDataOrderController.php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuatOrder;
use App\Models\TambahPelanggan;

class KasirDataOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        $query = BuatOrder::with('pelanggan');

        // Logika untuk fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                // Cari berdasarkan nama pelanggan
                $q->whereHas('pelanggan', function ($q2) use ($searchTerm) {
                    $q2->where('nama', 'like', '%' . $searchTerm . '%');
                })->orWhere('id', 'like', '%' . $searchTerm . '%'); // Atau cari berdasarkan ID order
            });
        }

        // Logika untuk fitur filter status
        if ($request->has('status') && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        // Pisahkan order yang belum selesai dan yang sudah selesai
        $orders = $query->where('status', '!=', 'Selesai')->orderBy('created_at', 'desc')->paginate(10);
        $historyOrders = BuatOrder::with('pelanggan')->where('status', 'Selesai')->orderBy('created_at', 'desc')->get();

        return view('kasir.data_order', compact('orders', 'historyOrders'));
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, BuatOrder $order)
    {
        $request->validate(['status' => 'required|in:Diproses,Sudah Bisa Diambil,Selesai']);

        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status berhasil diubah!', 'order' => $order]);
    }
}