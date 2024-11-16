<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;

class AdminController extends Controller
{
    public function index()
    {
        $totalPenjualan = Transaksi::where('total', '>', 0)->sum('total');
        $kasir = User::where('role','kasir')->count();
        $produk = Barang::all()->count();
        $pembayaran = JenisPembayaran::all()->count();
        return view('admin.index', compact('kasir','produk','pembayaran','totalPenjualan'));
    }
    public function kasir()
    {
        return view('kasir.index');
    }
    public function owner()
    {
        $kasir = User::where('role','kasir')->count();
        $produk = Barang::all()->count();
        $totalPenjualan = Transaksi::where('total', '>', 0)->sum('total');
        return view('owner.index', compact('kasir','produk','totalPenjualan'));
    }
}
