<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TambahPelanggan;

class KasirPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TambahPelanggan::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_handphone', 'like', "%{$search}%")
                  ->orWhere('provinsi', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('kodepos', 'like', "%{$search}%")
                  ->orWhere('detail_alamat', 'like', "%{$search}%");
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'nama_asc':
                    $query->orderBy('nama', 'asc');
                    break;
                case 'nama_desc':
                    $query->orderBy('nama', 'desc');
                    break;
                case 'terbaru':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'terlama':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            // Default sort
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $pelanggans = $query->paginate(10); // Menampilkan 10 data per halaman

        return view('kasir.pelanggan', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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

        TambahPelanggan::create($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = TambahPelanggan::findOrFail($id);
        return response()->json($pelanggan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        TambahPelanggan::where('id', $id)->update($validatedData);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TambahPelanggan::destroy($id);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
    }
}