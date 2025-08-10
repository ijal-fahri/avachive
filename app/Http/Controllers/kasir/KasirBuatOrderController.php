<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TambahPelanggan;
use App\Models\Layanan;
use App\Models\BuatOrder;

class KasirBuatOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = TambahPelanggan::all();
        $layanans = Layanan::all(); 
        return view('kasir.buat_order', compact('pelanggans', 'layanans'));
    }

    /**
     * Store a newly created resource in storage.
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
        
        // Simpan data order baru
        BuatOrder::create($validatedData);

        return redirect()->route('buat_order.index')->with('success', 'Order berhasil dibuat!');
    }
}