<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    public function index(Request $request)
    {
           $query = JenisPembayaran::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nm_pembayaran', 'like', '%' . $search . '%')
                ->orWhere('nomor', 'like', '%' . $search . '%');
        }

        $jenisPembayaran = $query->paginate(10);
        return view('admin.DataJenisPembayaran', compact('jenisPembayaran'));
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nm_pembayaran' => 'required',
            'nomor' => 'required',
        ],[
            'nm_pembayaran.required' => 'Nama Pembayaran Wajib Diisi',
            'nomor.required' => 'Nomor Wajib Diisi',
        ]);

        JenisPembayaran::create([
            'nm_pembayaran' => $validated['nm_pembayaran'],
            'nomor' => $validated['nomor'],
        ]);

        return redirect()->route('admin.jenispembayaran')->with('success', 'Jenis Pembayaran berhasil dibuat!');
    }
    public function delete($id)
    {
        $jenisPembayaran = JenisPembayaran::find($id);

        if ($jenisPembayaran) {
            $jenisPembayaran->delete();
              return redirect()->route('admin.jenispembayaran')->with('success', 'Jenis Pembayaran berhasil dihapus!');
        } else {
              return redirect()->route('admin.jenispembayaran')->with('error', 'Jenis Pembayaran tidak ditemukan!');
        }
    }
    public function edit($id)
    {
        $pembayaran = JenisPembayaran::findOrFail($id);
        return view('admin.EditJenisPembayaran', compact('pembayaran'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nm_pembayaran' => 'required',
            'nomor' => 'required',
        ],[
            'nm_pembayaran.required' => 'Nama Pembayaran Wajib Diisi',
            'nomor.required' => 'Nomor Wajib Diisi',
        ]);
        $pembayaran = JenisPembayaran::findOrFail($id);
    
        // Memperbarui data jenis pembayaran
        $pembayaran->update($validated);
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.jenispembayaran')->with('success', 'Data Jenis Pembayaran berhasil diperbarui!');
    }
}
