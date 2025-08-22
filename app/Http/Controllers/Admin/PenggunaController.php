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
        $users = User::where('usertype', '!=', 'admin')->get();
        return view('admin.pengguna.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'required|min:8',
            'usertype' => 'required|in:kasir,driver',
        ]);

        User::create([
        'name' => $request->name,
        'usertype' => $request->usertype,
        'password' => Hash::make($request->password),
        'plain_password' => $request->password, 
    ]);

        return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'password' => 'nullable|min:8',
            'usertype' => 'required|in:kasir,driver',
        ]);

        $data = [
            'name' => $request->name,
            'usertype' => $request->usertype,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['plain_password'] = $request->password; 
        }

        $user->update($data);

        return redirect()->route('datauser')->with('success', 'Pengguna diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('datauser')->with('success', 'Pengguna dihapus.');
    }
}
