<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function cetaklaporanTransaksi()
    {
        $DtTransaksi = Transaksi::where('total', '>', 0)->with('user')->get();

        return view('admin.CetakTransaksi', compact('DtTransaksi'));
    }
   
    public function nota($id)
    {
        // dd(request()->all());
        // $pembayaranId = request('pembayaran_id');
        // $pembayaran = Transaksi::find($id);
        // $data = [
        //     'pembayaran_id' => $pembayaranId
        // ];
        // $pembayaran->update($data);
        $id_transaksi = Transaksi::findOrFail($id);
        return view('kasir.CetakNota', compact('id_transaksi'));
    }

    // Nota Admin
    public function notaAdmin($id)
    {
        // dd(request()->all());
        // $pembayaranId = request('pembayaran_id');
        // $pembayaran = Transaksi::find($id);
        // $data = [
        //     'pembayaran_id' => $pembayaranId
        // ];
        // $pembayaran->update($data);
        $id_transaksi = Transaksi::findOrFail($id);
        return view('admin.CetakNota', compact('id_transaksi'));
    } 
    // Fungsi Di Owner
    public function OwnercetaklaporanTransaksi()
    {
        $DtTransaksi = Transaksi::where('total', '>', 0)->with('user')->get();

        return view('owner.CetakTransaksi', compact('DtTransaksi'));
    }
    public function cetakStrukTransaksi($id)
    {
        $t_detail = Transaksi::with('transaksidetail.barang','user')->findOrFail($id);
        $total_item = $t_detail->transaksidetail->sum('qty');
        return view('admin.CetakStrukBelanja', compact('t_detail','total_item'));
    }
}
