<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiDetailContoller extends Controller
{
    public function create(Request $request) 
    {
        // dd($request->all());
        $barang = $request->nm_barang;
        $transaksi = $request->transaksi_id;
        $td = TransaksiDetail::where('nm_barang', $barang)->where('transaksi_id', $transaksi)->first();
        $transaksi_id = Transaksi::find($transaksi);
        $validated = $request->validate([
            'transaksi_id' => 'required',
            'nm_barang' => 'required',
            'qty' => 'required',
            'harga_satuan' => 'required',
        ]);
        $subtotal = request('harga_satuan') * request('qty');
        if ($td == null) {
             TransaksiDetail::create([
            'transaksi_id' => $validated['transaksi_id'],
            'nm_barang' => $validated['nm_barang'],
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
        return redirect()->back()->with('success', 'Transaksi berhasil dibuat!');
    }
    public function delete()
    {
        $id = request(('id'));
        $td = TransaksiDetail::find($id); 
        $transaksi = Transaksi::find($td->transaksi_id);
        $data = [
            'total' => $transaksi->total - $td->subtotal
        ];
        $transaksi->update($data);
        $td->delete();
        return redirect()->back();
    }
    public function detail($id)
    {
        $detail = Transaksi::with('transaksidetail')->findOrFail($id);
        return view('kasir.DetailTransaksi', compact('detail'));
    }
    public function Ownerdetail($id)
    {
        $detail = Transaksi::with('transaksidetail')->findOrFail($id);
        return view('owner.DetailTransaksi', compact('detail'));
    }
}
