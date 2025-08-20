<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TambahPelanggan;
use App\Models\Layanan;
use App\Models\BuatOrder;
use Illuminate\Support\Facades\Auth; // <-- DITAMBAHKAN

class KasirBuatOrderController extends Controller
{
    /**
     * Menampilkan halaman pembuatan order.
     */
    public function index()
    {
        // Ambil ID cabang dari kasir yang sedang login
        $cabangId = Auth::user()->cabang_id;

        // Ambil pelanggan dan layanan HANYA dari cabang tersebut
        $pelanggans = TambahPelanggan::where('cabang_id', $cabangId)->get();
        $layanans = Layanan::where('cabang_id', $cabangId)->get(); 
        
        return view('kasir.buat_order', compact('pelanggans', 'layanans'));
    }

    /**
     * Menyimpan order baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tambah_pelanggan_id' => 'required|exists:tambah_pelanggans,id',
            'layanan' => 'required|json',
            'metode_pembayaran' => 'required|string',
            'waktu_pembayaran' => 'required|string',
            'metode_pengambilan' => 'required|string',
            'total_harga' => 'required|numeric',
        ]);
        
        // DITAMBAHKAN: Sisipkan ID cabang kasir & status default secara otomatis
        $validatedData['cabang_id'] = Auth::user()->cabang_id;
        $validatedData['status'] = 'Baru';

        // Simpan data order baru
        BuatOrder::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil disimpan'
        ]);
    }
}