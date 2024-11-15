<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function cetaklaporanTransaksi()
    {
        $DtTransaksi = Transaksi::all();

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
        $pembayaran_id = JenisPembayaran::all();
        return view('kasir.CetakNota', compact('pembayaran_id'));
    }
}
