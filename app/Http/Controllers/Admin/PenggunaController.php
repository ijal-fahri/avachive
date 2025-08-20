<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cabangId = session('cabang_aktif_id');
        $query = User::where('usertype', '!=', 'owner');

        if ($user->usertype !== 'owner') {
            $query->where('cabang_id', $user->cabang_id);
        } 
        elseif ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }

        $users = $query->get();
        return view('admin.pengguna.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|min:8',
            'usertype' => 'required|in:kasir,driver,admin',
        ]);
        
        // DIUBAH: Sisipkan ID cabang yang aktif dari session secara otomatis
        $validatedData['cabang_id'] = session('cabang_aktif_id');
        $validatedData['password'] = Hash::make($request->password);
        $validatedData['plain_password'] = $request->password;

        // Tambahkan pengecekan jika tidak ada cabang aktif
        if (!$validatedData['cabang_id']) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada cabang yang aktif untuk menambahkan karyawan.']);
        }

        User::create($validatedData);

        return redirect()->route('datauser')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, User $pengguna)
    {
        if (Auth::user()->usertype !== 'owner' && $pengguna->cabang_id != Auth::user()->cabang_id) {
            abort(403, 'AKSES DITOLAK.');
        }

        $request->validate([
            'name' => 'required|string',
            'password' => 'nullable|min:8',
            'usertype' => 'required|in:kasir,driver,admin',
        ]);

        $data = [ 'name' => $request->name, 'usertype' => $request->usertype ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['plain_password'] = $request->password;
        }
        $pengguna->update($data);

        return redirect()->route('datauser')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        if (Auth::user()->usertype !== 'owner' && $pengguna->cabang_id != Auth::user()->cabang_id) {
            abort(403, 'AKSES DITOLAK.');
        }

        $pengguna->delete();
        return redirect()->route('datauser')->with('success', 'Pengguna berhasil dihapus.');
    }
}