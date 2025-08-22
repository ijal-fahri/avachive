<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Layanan::query();

        if ($user->usertype !== 'owner') {
            $query->where('cabang_id', $user->cabang_id);
        } else {
            $cabangId = session('cabang_aktif_id');
            if ($cabangId) {
                $query->where('cabang_id', $cabangId);
            }
        }

        $layanans = $query->latest()->get(); 
        return view('admin.layanan.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'paket' => 'required|string',
            'kategori' => 'required|string|in:Kiloan,Satuan',
            'harga' => 'required|numeric|min:0',
        ]);

        // DIUBAH: Sisipkan ID cabang yang aktif dari session secara otomatis
        $validatedData['cabang_id'] = session('cabang_aktif_id');

        // Tambahkan pengecekan jika tidak ada cabang aktif
        if (!$validatedData['cabang_id']) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada cabang yang aktif untuk menambahkan layanan.']);
        }

        Layanan::create($validatedData);

        return redirect()->route('produk.index', ['tab' => $request->kategori])
                         ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, Layanan $produk)
    {
        // Keamanan: Pastikan owner bisa edit semua, atau admin cabang hanya bisa edit data di cabangnya
        if (Auth::user()->usertype !== 'owner' && $produk->cabang_id != Auth::user()->cabang_id) {
            abort(403, 'Akses ditolak.');
        }

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'paket' => 'required|string',
            'kategori' => 'required|string|in:Kiloan,Satuan',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk->update($validatedData);

        return redirect()->route('produk.index', ['tab' => $request->kategori])
                         ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $produk)
    {
        // Keamanan: Pastikan owner bisa hapus semua, atau admin cabang hanya bisa hapus data di cabangnya
        if (Auth::user()->usertype !== 'owner' && $produk->cabang_id != Auth::user()->cabang_id) {
            abort(403, 'Akses ditolak.');
        }
        
        $kategori = $produk->kategori;
        $produk->delete();

        return redirect()->route('produk.index', ['tab' => $kategori])
                         ->with('success', 'Layanan berhasil dihapus.');
    }
}