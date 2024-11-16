<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($query) use ($search) {
                $query->where('user_id', 'like', '%' . $search . '%')
                    ->orWhere('total', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%');
            });
        }

        $transaksi = $query->where('total', '>', 0)
                        ->with('user') 
                        ->paginate(10);

        return view('kasir.HistoriOrder', compact('transaksi'));
    }
   
    public function create(Request $request)
    {
        $transaksiTerakhir = Transaksi::latest('created_at')->first();
        $prefix = 'TRI' . date('Y');
        $noTransaksiTerakhir = $transaksiTerakhir ? $transaksiTerakhir->no_transaksi : null;
        if ($noTransaksiTerakhir) {
            $nomorTerakhir = (int) substr($noTransaksiTerakhir, -6);
            $nomorBaru = str_pad($nomorTerakhir + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nomorBaru = '000001';
        }
        $noTransaksi = $prefix . '-' . $nomorBaru;

        $user = Auth::id();
        $pembayaran = $request->pembayaran_id;
        $total = '0';
        $transaksi = Transaksi::create([
            'user_id' => $user,
            'pembayaran_id' => '0',
            'total' => $total,
            'dibayarkan' => '0',
            'no_transaksi'=>  $noTransaksi,
        ]);

        return redirect()->route('kasir.tambah.transaksi', $transaksi->id);
    }
    public function tambah($id)
    {
        // dd(request()->all());
        $produk = Barang::all();
        $produk_id = request('barang_id');
        $transaksi_id = request('transaksi_id');
        $p_detail = Barang::find($produk_id);
        $qty = request('qty'); 
        $transaksi_detail = Transaksi::with('transaksidetail.barang')->findOrFail($id);
        $total = Transaksi::find($id);
        $bayar = request('total_belanja');
        $kembalian = $total->dibayarkan - $total->total;
        $dibayarkan = $total->dibayarkan;
        $pembayaran_id = JenisPembayaran::all();

        return view('kasir.Transaksi', compact('dibayarkan','produk','p_detail','transaksi_detail','total','kembalian','pembayaran_id'));
    } 
    public function update()
    {
        // dd(request()->all());
        
        $transaksi_id = request('transaksi_id');
        $pembayaran = request('pembayaran_id');
        $jns_pembayaran = Transaksi::find($transaksi_id);
        $data = [
            'pembayaran_id' => $pembayaran
        ];
        $jns_pembayaran->update($data);
        return redirect()->route('kasir.nota', $transaksi_id);
    }

    public function indexOwner(Request $request)
    {
         $query = Transaksi::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($query) use ($search) {
                $query->where('user_id', 'like', '%' . $search . '%')
                    ->orWhere('total', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%');
            });
        }

        $transaksi = $query->where('total', '>', 0)
                        ->with('user') 
                        ->paginate(10);
        return view('owner.HistoriOrder', compact('transaksi'));
    }

    // Admin Transaksi
     public function createAdmin(Request $request)
    {
         $transaksiTerakhir = Transaksi::latest('created_at')->first();
        $prefix = 'TR-' . date('Y');
        $noTransaksiTerakhir = $transaksiTerakhir ? $transaksiTerakhir->no_transaksi : null;
        if ($noTransaksiTerakhir) {
            $nomorTerakhir = (int) substr($noTransaksiTerakhir, -6);
            $nomorBaru = str_pad($nomorTerakhir + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nomorBaru = '000001';
        }
        $noTransaksi = $prefix . '-' . $nomorBaru;

        $user = Auth::id();
        $pembayaran = $request->pembayaran_id;
        $total = '0';
        $transaksi = Transaksi::create([
            'user_id' => $user,
            'pembayaran_id' => '0',
            'total' => $total,
            'dibayarkan' => '0',
            'no_transaksi'=>  $noTransaksi,
        ]);

        return redirect()->route('admin.tambah.transaksi', $transaksi->id);
    }
       public function tambahAdmin($id)
    {
        // dd(request()->all());
        $produk = Barang::all();
        $produk_id = request('barang_id');
        $transaksi_id = request('transaksi_id');
        $p_detail = Barang::find($produk_id);
        $qty = request('qty');
        $transaksi_detail = Transaksi::with('transaksidetail.barang')->findOrFail($id);
        $total = Transaksi::find($id);
        $bayar = request('total_belanja');
        $kembalian = $total->dibayarkan - $total->total;
        $dibayarkan = $total->dibayarkan;
        $pembayaran_id = JenisPembayaran::all();

        return view('admin.TransaksiAdmin', compact('dibayarkan','produk','p_detail','transaksi_detail','total','kembalian','pembayaran_id'));
    } 

    // Update jenis pembayaran admin
       public function updateAdmin()
    {
        // dd(request()->all());
        $transaksi_id = request('transaksi_id');
        $pembayaran = request('pembayaran_id');
        $jns_pembayaran = Transaksi::find($transaksi_id);
        $data = [
            'pembayaran_id' => $pembayaran
        ];
        $jns_pembayaran->update($data);
        return redirect()->route('admin.nota', $transaksi_id);
    }
    public function dibayarkan()
    {
        $transaksi_id = request('transaksi_id');
        $transaksi = Transaksi::find($transaksi_id);
        $data = [
            'dibayarkan' => request('dibayarkan'),
        ];
        $transaksi->update($data);
        return redirect()->back();
    }
}
