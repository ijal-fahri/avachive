<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->get(); 
        return view('admin.layanan.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'paket' => 'required|string',
            'kategori' => 'required|string|in:Kiloan,Satuan',
            'harga' => 'required|numeric|min:0',
        ]);

        Layanan::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * NAMA VARIABEL DIUBAH DARI $layanan MENJADI $produk
     */
    public function update(Request $request, Layanan $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'paket' => 'required|string',
            'kategori' => 'required|string|in:Kiloan,Satuan',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk->update($request->all()); // <-- Menggunakan $produk

        return redirect()->route('produk.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * NAMA VARIABEL DIUBAH DARI $layanan MENJADI $produk
     */
    public function destroy(Layanan $produk)
    {
        $produk->delete(); // <-- Menggunakan $produk

        return redirect()->route('produk.index')->with('success', 'Layanan berhasil dihapus.');
    }
}