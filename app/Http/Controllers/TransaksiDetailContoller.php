<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiDetailContoller extends Controller
{
    public function create(Request $request) 
    {
        // dd($request->all());
        $barang_id = $request->barang_id;
        $transaksi = $request->transaksi_id;
        $td = TransaksiDetail::where('barang_id', $barang_id)->where('transaksi_id', $transaksi)->first();
        $transaksi_id = Transaksi::find($transaksi);
        $validated = $request->validate([
            'transaksi_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required|numeric|min:1',
            'harga_satuan' => 'required',
        ],[
            'barang_id.required' => 'Barang Wajib Dipilih',
            'qty.required' => 'Quantity Wajib diisi',
            'qty.min' => 'Quantity yang anda masukan harus lebih atau samadengan 1',
        ]);
        $subtotal = request('harga_satuan') * request('qty');
         $barang = Barang::find($barang_id);
       if ($barang->stok < $request->qty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        } elseif ($barang->stok >= $request->qty){
        $data = [
            'stok' => $barang->stok - $request->qty
        ];
        $barang->update($data);
        if ($td == null) {
             TransaksiDetail::create([
            'transaksi_id' => $validated['transaksi_id'],
            'barang_id' => $validated['barang_id'],
            'qty' => $validated['qty'],
            'subtotal' => $subtotal,
        ]);
        $dt = [
            'total' => request('harga_satuan') * request('qty') + $transaksi_id->total,
        ];
        $transaksi_id->update($dt);
        } else {
            $validated = [
                'qty' => $td->qty + $request->qty,
                'subtotal' => $subtotal + $td->subtotal
            ];
            $td->update($validated);
            $dt = [
                'total' => $subtotal + $transaksi_id->total,
            ];
            $transaksi_id->update($dt);
        }
        }
        return redirect()->back()->with('success', 'Transaksi berhasil dibuat!');
    }
    public function delete()
    {
        $barang_id = request('barang_id');
        $id = request('id');
        
        $barang = Barang::find($barang_id);
        $td = TransaksiDetail::find($id); 
        $transaksi = Transaksi::find($td->transaksi_id);

        $transaksi->update([
            'total' => $transaksi->total - $td->subtotal
        ]);
        $barang->update([
            'stok' => $barang->stok + $td->qty
        ]);
        $td->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function detail($id)
    {
        $detail = Transaksi::with('transaksidetail.barang')->findOrFail($id);
        return view('kasir.DetailTransaksi', compact('detail'));
    }
    public function Ownerdetail($id)
    {
        $detail = Transaksi::with('transaksidetail.barang')->findOrFail($id);
        return view('owner.DetailTransaksi', compact('detail'));
    }

    // Transaksi Admin
     public function createAdmin(Request $request) 
    {
        // dd($request->all());
        $barang_id = $request->barang_id;
        $transaksi = $request->transaksi_id;
        $td = TransaksiDetail::where('barang_id', $barang_id)->where('transaksi_id', $transaksi)->first();
        $transaksi_id = Transaksi::find($transaksi);
        $validated = $request->validate([
            'transaksi_id' => 'required',
            'barang_id' => 'required',
            'qty' => 'required|numeric|min:1',
            'harga_satuan' => 'required',
        ],[
            'barang_id.required' => 'Barang Wajib Dipilih',
            'qty.required' => 'Quantity Wajib diisi',
            'qty.min' => 'Quantity yang anda masukan harus lebih atau samadengan 1',
        ]);
        $subtotal = request('harga_satuan') * request('qty');
         $barang = Barang::find($barang_id);
       if ($barang->stok < $request->qty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        } elseif ($barang->stok >= $request->qty){
        $data = [
            'stok' => $barang->stok - $request->qty
        ];
        $barang->update($data);
        if ($td == null) {
             TransaksiDetail::create([
            'transaksi_id' => $validated['transaksi_id'],
            'barang_id' => $validated['barang_id'],
            'qty' => $validated['qty'],
            'subtotal' => $subtotal,
        ]);
        $dt = [
            'total' => request('harga_satuan') * request('qty') + $transaksi_id->total,
        ];
        $transaksi_id->update($dt);
        } else {
            $validated = [
                'qty' => $td->qty + $request->qty,
                'subtotal' => $subtotal + $td->subtotal
            ];
            $td->update($validated);
            $dt = [
                'total' => $subtotal + $transaksi_id->total,
            ];
            $transaksi_id->update($dt);
        }
        }
        return redirect()->back()->with('success', 'Transaksi berhasil dibuat!');
    }
    public function deleteAdmin()
    {
        // dd(request()->all());
        $barang_id = request('barang_id');
        $id = request('id');
        $barang = Barang::find($barang_id);
        $td = TransaksiDetail::find($id); 
        $transaksi = Transaksi::find($td->transaksi_id);
        $data = [
            'total' => $transaksi->total - $td->subtotal
        ];
        $transaksi->update($data);
        $td->delete();
        $db = [
            'stok' => $barang->stok + $td->qty
        ];
        $barang->update($db);
        return redirect()->back();
    }
}
