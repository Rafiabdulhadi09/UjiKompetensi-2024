<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $kasir = User::where('role','kasir')->get();
        return view('admin.DataPetugas', compact('kasir'));
    }
    public function create(Request $request)
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
    public function indexOwner()
    {
        $kasir = User::where('role','kasir')->get();
        return view('owner.DataKasir', compact('kasir'));
    }


}
