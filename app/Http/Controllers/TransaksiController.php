<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $pembayaran = JenisPembayaran::all();
        $transaksi = Transaksi::with('user')->get();
        return view('kasir.HistoriOrder', compact('pembayaran','transaksi'));
    }
   
    public function create(Request $request)
    {
        $user = Auth::id();
        $pembayaran = $request->pembayaran_id;
        $total = '0';
        $transaksi = Transaksi::create([
            'user_id' => $user,
            'pembayaran_id' => '0',
            'total' => $total
        ]);

        return redirect()->route('kasir.tambah.transaksi', $transaksi->id);
    }
    public function tambah($id)
    {
        $produk = Barang::all();
        $produk_id = request('barang_id');
        $transaksi_id = request('transaksi_id');
        $p_detail = Barang::find($produk_id);
        $qty = request('qty');
        $transaksi_detail = Transaksi::with('transaksidetail')->findOrFail($id);
        $total = Transaksi::find($id);
        $bayar = request('total_belanja');
        $kembalian = request('dibayarkan') - $bayar;
        $pembayaran_id = JenisPembayaran::all();

        return view('kasir.Transaksi', compact('produk','p_detail','transaksi_detail','total','kembalian','pembayaran_id'));
    } 
    public function indexOwner()
    {
        $pembayaran = JenisPembayaran::all();
        $transaksi = Transaksi::with('user')->get();
        return view('owner.HistoriOrder', compact('pembayaran','transaksi'));
    }
}
