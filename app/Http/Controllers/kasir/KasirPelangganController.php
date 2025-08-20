<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TambahPelanggan;
use Illuminate\Support\Facades\Auth; // <-- DITAMBAHKAN

class KasirPelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan sesuai cabang kasir.
     */
    public function index(Request $request)
    {
        // Ambil ID cabang dari kasir yang sedang login
        $cabangId = Auth::user()->cabang_id;

        // DIUBAH: Mulai query dengan filter cabang terlebih dahulu
        $query = TambahPelanggan::where('cabang_id', $cabangId);

        // Search (logika ini sudah benar)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_handphone', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%");
            });
        }

        // Sort (logika ini sudah benar)
        if ($request->filled('sort')) {
            // ... (logika sort Anda tidak perlu diubah)
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $pelanggans = $query->paginate(10);

        return view('kasir.pelanggan', compact('pelanggans'));
    }

    /**
     * Menyimpan pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'no_handphone' => 'required|max:20',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required',
            'detail_alamat' => 'required',
        ]);

        // DITAMBAHKAN: Sisipkan ID cabang kasir secara otomatis
        $validatedData['cabang_id'] = Auth::user()->cabang_id;

        TambahPelanggan::create($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    /**
     * Mengambil data pelanggan untuk form edit.
     */
    public function edit(string $id)
    {
        // DITAMBAHKAN: Pengecekan keamanan
        $pelanggan = TambahPelanggan::where('id', $id)
                                    ->where('cabang_id', Auth::user()->cabang_id)
                                    ->firstOrFail(); // Akan error jika pelanggan tidak ditemukan di cabang ini
        return response()->json($pelanggan);
    }

    /**
     * Memperbarui data pelanggan.
     */
    public function update(Request $request, string $id)
    {
        // DITAMBAHKAN: Pengecekan keamanan
        $pelanggan = TambahPelanggan::where('id', $id)
                                    ->where('cabang_id', Auth::user()->cabang_id)
                                    ->firstOrFail();

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'no_handphone' => 'required|max:20',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required',
            'detail_alamat' => 'required',
        ]);

        $pelanggan->update($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate!');
    }

    /**
     * Menghapus data pelanggan.
     */
    public function destroy(string $id)
    {
        // DITAMBAHKAN: Pengecekan keamanan
        $pelanggan = TambahPelanggan::where('id', $id)
                                    ->where('cabang_id', Auth::user()->cabang_id)
                                    ->firstOrFail();
        
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
    }
}