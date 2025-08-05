<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.pengguna.index', compact('users'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|in:Kasir,Driver',
    ]);

    // Simpan ke database
    User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'role' => $request->role,
        'password' => Hash::make('default123'), // password default
    ]);

    // Redirect atau return back
    return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan.');
}
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:Kasir,Driver',
    ]);

    $user->update([
        'name' => $request->nama,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('datauser')->with('success', 'Pengguna diperbarui.');
}
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('datauser')->with('success', 'Pengguna dihapus.');
    }
}
