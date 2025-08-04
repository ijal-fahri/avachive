<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('produk', compact('services'));
    }

    public function store(Request $request)
    {
        Service::create($request->all());
        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $layanan = Service::findOrFail($id);
        $layanan->update($request->all());
        return redirect()->back()->with('success', 'Layanan berhasil diupdate');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus');
    }
}
