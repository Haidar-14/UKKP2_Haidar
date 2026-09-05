<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user sesuai role
    public function index()
    {
        $userLogin = Auth::user();

        if ($userLogin->role === 'admin') {
            $users = User::orderBy('nama', 'asc')->get();
        } elseif ($userLogin->role === 'petugas') {
            $users = User::whereIn('role', ['petugas', 'user'])
                ->orderBy('nama', 'asc')
                ->get();
        } else {
            abort(403, 'Akses ditolak.');
        }

        return view('admin.user', compact('users'));
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $userLogin = Auth::user();

        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'no_telp'  => 'nullable|numeric|digits_between:10,15',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,petugas,user',
        ]);

        // Petugas hanya boleh membuat user biasa
        if ($userLogin->role === 'petugas' && $request->role !== 'user') {
            abort(403, 'Petugas hanya bisa membuat user biasa.');
        }

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_telp'  => $request->no_telp,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Mengupdate user
    public function update(Request $request, $id)
    {
        $userLogin = Auth::user();
        $target = User::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|unique:users,email,' . $id,
            'no_telp' => 'nullable|numeric|digits_between:10,15',
            'role'    => 'required|in:admin,petugas,user',
        ]);

        // Petugas tidak boleh edit admin/petugas lain
        if ($userLogin->role === 'petugas' && $target->role !== 'user') {
            abort(403, 'Petugas hanya bisa mengubah user biasa.');
        }

        // Petugas tidak boleh mengubah role menjadi selain user
        if ($userLogin->role === 'petugas' && $request->role !== 'user') {
            abort(403, 'Petugas hanya bisa mengubah role menjadi user.');
        }

        $target->update([
            'nama'    => $request->nama,
            'email'   => $request->email,
            'no_telp' => $request->no_telp,
            'role'    => $request->role,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus user
    public function destroy($id)
    {
        $userLogin = Auth::user();
        $target = User::findOrFail($id);

        // Admin tidak bisa hapus diri sendiri
        if ($userLogin->id === $target->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        // Petugas hanya bisa hapus user biasa
        if ($userLogin->role === 'petugas' && $target->role !== 'user') {
            abort(403, 'Petugas hanya bisa menghapus user biasa.');
        }

        $target->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}