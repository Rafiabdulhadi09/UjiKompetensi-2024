<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $kasir = User::where('role','kasir')->count();
        $produk = Barang::all()->count();
        $pembayaran = JenisPembayaran::all()->count();
        return view('admin.index', compact('kasir','produk','pembayaran'));
    }
    public function kasir()
    {
        return view('kasir.index');
    }
    public function owner()
    {
        return view('owner.index');
    }
}
