<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'paket' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer',
        ]);

        Layanan::create($request->all());

        return redirect()->route('produk')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'paket' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer',
        ]);

        $layanan->update($request->all());

        return redirect()->route('produk')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();

        return redirect()->route('produk')->with('success', 'Layanan berhasil dihapus.');
    }
}
