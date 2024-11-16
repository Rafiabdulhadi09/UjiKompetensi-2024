<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index(Request $request)
    {
           $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('role', 'like', '%' . $search . '%');
        }

        $kasir = $query->where('role','kasir')
                        ->paginate(10);
        return view('admin.DataPetugas', compact('kasir'));
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ],[
            'name.required' => 'Nama Wajib Diisi',
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'username.unique' => 'Username Sudah Tersedia',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'role' => 'kasir',
        ]);

        return redirect()->route('admin.datakasir')->with('success', 'User berhasil dibuat!');
    }
    public function delete($id)
    {
        $kasir = User::find($id);

        if ($kasir) {
            $kasir->delete();
              return redirect()->route('admin.datakasir')->with('success', 'Kasir berhasil dihapus!');
        } else {
              return redirect()->route('admin.datakasir')->with('error', 'Kasir tidak ditemukan!');
        }
    }

    public function edit($id)
    {
        $kasir = User::findOrFail($id);
        return view('admin.EditKasir', compact('kasir'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'Nama Wajib Diisi',
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);
        $kasir = User::findOrFail($id);
    
        // Memperbarui data jenis pembayaran
        $kasir->update($validated);
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.datakasir')->with('success', 'Kasir berhasil diperbarui!');
    }

    // Fungsi Pada Owner
    public function indexOwner(Request $request)
    {
           $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%');
        }

        $kasir = $query->where('role', 'kasir')->paginate(10);
        return view('owner.DataKasir', compact('kasir'));
    }


}
