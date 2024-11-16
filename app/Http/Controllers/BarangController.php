<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
         $query = Barang::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nm_barang', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%')
                ->orWhere('ukuran', 'like', '%' . $search . '%');
        }

        $barang = $query->paginate(10);
        return view('admin.DataBarang', compact('barang'));
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nm_barang' => 'required',
            'stok' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:1',
            'ukuran' => 'required|min:1'
        ],[
            'nm_barang.required' => 'Nama Barang Wajib Diisi',
            'stok.required' => 'Stok Barang Wajib Diisi',
            'harga.required' => 'Harga Barang Wajib Diisi',
            'ukuran.required' => 'Ukuran Barang Wajib Diisi',
            'stok.min' => 'Input yang anda masukan setidaknya 1',
            'harga.min' => 'Input yang anda masukan setidaknya 1',
            'ukuran.min' => 'Input yang anda masukan setidaknya 1',
        ]);

        Barang::create([
            'nm_barang' => $validated['nm_barang'],
            'stok' => $validated['stok'],
            'harga' => $validated['harga'],
            'ukuran' => $validated['ukuran'],
        ]);

        return redirect()->route('admin.databarang')->with('success', 'Barang berhasil dibuat!');
    }
    public function edit ($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.EditDataBarang', compact('barang'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nm_barang' => 'required',
            'stok' => 'required|min:0',
            'harga' => 'required|min:0',
            'ukuran' => 'required|min:0'
        ],[
            'nm_barang.required' => 'Nama Barang Wajib Diisi',
            'stok.required' => 'Stok Barang Wajib Diisi',
            'harga.required' => 'Harga Barang Wajib Diisi',
            'ukuran.required' => 'Ukuran Barang Wajib Diisi',
            'stok|min:0' => 'Anda memasukan harus lebih dari 1',
            'harga|min:0' => 'Anda memasukan harus lebih dari 1',
            'ukuran|min:0' => 'Anda memasukan harus lebih dari 1',
            'ukuran.min:0' => 'Anda memasukan harus lebih dari 1',
        ]);
    
        $barang = Barang::findOrFail($id);
    
        // Memperbarui data jenis pembayaran
        $barang->update($validated);
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.databarang')->with('success', 'Data Barang berhasil diperbarui!');
    }
    public function delete($id)
    {
        $barang = Barang::find($id);

        if ($barang) {
            $barang->delete();

              return redirect()->route('admin.databarang')->with('success', 'Produk berhasil dihapus!');
        } else {
              return redirect()->route('admin.databarang')->with('error', 'Produk tidak ditemukan!');
        }
    }

    // Fungsi Kasir
    public function indexKasir(Request $request)
    {
         $query = Barang::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nm_barang', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%')
                ->orWhere('ukuran', 'like', '%' . $search . '%');
        }

        $barang = $query->paginate(10);
        return view('kasir.DataBarang', compact('barang'));
    }

    public function indexOwner(Request $request)
    {
        $query = Barang::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nm_barang', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%')
                ->orWhere('ukuran', 'like', '%' . $search . '%');
        }

        $barang = $query->paginate(10);
        return view('owner.DataBarang', compact('barang'));
    }
}
