<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailContoller;
use App\Http\Controllers\UsersController;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function(){
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'login'])->name('login');
});

    Route::get('/home', function(){
        return redirect('/admin');
    });

Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin');
    Route::get('/cetak/struk/{id}/transaksi', [GenerateController::class, 'cetakStrukTransaksi'])->name('cetak.struk');
    // data barang
    Route::get('/admin/databarang', [BarangController::class, 'index'])->name('admin.databarang')->middleware('userAkses:admin');
    Route::get('/admin/edit/{id}/databarang', [BarangController::class, 'edit'])->name('admin.edit.databarang')->middleware('userAkses:admin');
    Route::put('/admin/update/{id}/databarang', [BarangController::class, 'update'])->name('admin.update.databarang')->middleware('userAkses:admin');
    Route::post('/admin/create/databarang', [BarangController::class, 'create'])->name('admin.create.produk')->middleware('userAkses:admin');
    Route::delete('/admin/delete/{id}/databarang', [BarangController::class, 'delete'])->name('admin.delete.produk')->middleware('userAkses:admin');
    // end data barang
    // data kasir
    Route::get('/admin/datakasir', [KasirController::class, 'index'])->name('admin.datakasir')->middleware('userAkses:admin');
   
    Route::get('/admin/edit/{id}/kasir', [KasirController::class, 'edit'])->name('admin.edit.datakasir')->middleware('userAkses:admin');
    Route::put('/admin/update/{id}/kasir', [KasirController::class, 'update'])->name('admin.update.datakasir')->middleware('userAkses:admin');
    Route::post('/admin/create/kasir', [KasirController::class, 'create'])->name('admin.create.kasir')->middleware('userAkses:admin');
    Route::delete('/admin/delete/{id}/kasir', [KasirController::class, 'delete'])->name('admin.delete.kasir')->middleware('userAkses:admin');
    // end data kasir
    // data Jenis Pembayaran
    Route::get('/admin/datapembayaran', [JenisPembayaranController::class, 'index'])->name('admin.jenispembayaran')->middleware('userAkses:admin');
    Route::get('/admin/edit/{id}/pembayaran', [JenisPembayaranController::class, 'edit'])->name('admin.edit.pembayaran')->middleware('userAkses:admin');
    Route::put('/admin/update/{id}/pembayaran', [JenisPembayaranController::class, 'update'])->name('admin.update.pembayaran')->middleware('userAkses:admin');
    Route::post('/admin/create/datapembayaran', [JenisPembayaranController::class, 'create'])->name('admin.create.jenispembayaran')->middleware('userAkses:admin');
    Route::delete('/admin/delete/{id}/jenispembayaran', [JenisPembayaranController::class, 'delete'])->name('admin.delete.jenispembayaran')->middleware('userAkses:admin');
    // end data jenis pembayaran

    // Transaksi   

    Route::get('/admin/cetak/laporan/transaksi', [GenerateController::class, 'cetaklaporanTransaksi'])->name('admin.cetak.laporan')->middleware('userAkses:admin');
    Route::get('/admin/create/transaksi', [TransaksiController::class, 'createAdmin'])->name('admin.create.histori')->middleware('userAkses:admin');
    Route::get('/admin/tambah/transaksi/{id}', [TransaksiController::class, 'tambahAdmin'])->name('admin.tambah.transaksi')->middleware('userAkses:admin');
    Route::post('/admin/create/transaksidetail', [TransaksiDetailContoller::class, 'createAdmin'])->name('admin.create.transaksi')->middleware('userAkses:admin');
    Route::get('/admin/delete/transaksidetail', [TransaksiDetailContoller::class, 'deleteAdmin'])->name('admin.delete.transaksi')->middleware('userAkses:admin');
    Route::get('/update/jenis/pembayaran/admin', [TransaksiController::class, 'updateAdmin'])->name('update.jenis.pembayaran.admin')->middleware('userAkses:admin');
    Route::get('/nota/{id}/', [GenerateController::class, 'notaAdmin'])->name('admin.nota')->middleware('userAkses:admin');
    Route::get('/update/transaksi/dibayarkan', [TransaksiController::class, 'dibayarkan'])->name('update.dibayarkan');
    // end Transaksi




    Route::get('/kasir', [AdminController::class, 'kasir'])->name('kasir')->middleware('userAkses:kasir');
    // data barang
    Route::get('/kasir/databarang', [BarangController::class, 'indexKasir'])->name('kasir.databarang')->middleware('userAkses:kasir');
    Route::get('/kasir/detail/{id}/transaksi', [TransaksiDetailContoller::class, 'detail'])->name('kasir.detail.transaksi')->middleware('userAkses:kasir');
    Route::get('/kasir/lihat/histori', [TransaksiController::class, 'index'])->name('kasir.lihat.histori')->middleware('userAkses:kasir');
    Route::get('/kasir/create/transaksi', [TransaksiController::class, 'create'])->name('kasir.create.histori')->middleware('userAkses:kasir');
    Route::get('/kasir/tambah/transaksi/{id}', [TransaksiController::class, 'tambah'])->name('kasir.tambah.transaksi')->middleware('userAkses:kasir');
    Route::post('/kasir/create/transaksidetail', [TransaksiDetailContoller::class, 'create'])->name('kasir.create.transaksi')->middleware('userAkses:kasir');
    Route::get('/kasir/delete/transaksidetail', [TransaksiDetailContoller::class, 'delete'])->name('kasir.delete.transaksi')->middleware('userAkses:kasir');
    Route::get('/kasir/{id}/nota', [GenerateController::class, 'nota'])->name('kasir.nota')->middleware('userAkses:kasir');
    Route::get('/update/jenis/pembayaran', [TransaksiController::class, 'update'])->name('update.jenis.pembayaran')->middleware('userAkses:kasir');
    // end data barang

    Route::get('/owner', [AdminController::class, 'owner'])->name('owner')->middleware('userAkses:owner');
    // owner manage data
    Route::get('/owner/databarang', [BarangController::class, 'indexOwner'])->name('owner.databarang')->middleware('userAkses:owner');
    Route::get('/owner/datakasir', [KasirController::class, 'indexOwner'])->name('owner.datakasir')->middleware('userAkses:owner');
    Route::get('/owner/detail/{id}/transaksi', [TransaksiDetailContoller::class, 'Ownerdetail'])->name('owner.detail.transaksi')->middleware('userAkses:owner');
    Route::get('/owner/lihat/histori', [TransaksiController::class, 'indexOwner'])->name('owner.lihat.histori')->middleware('userAkses:owner');
    Route::get('/owner/cetak/laporan/transaksi', [GenerateController::class, 'OwnercetaklaporanTransaksi'])->name('owner.cetak.laporan')->middleware('userAkses:owner');

    // end manage


    Route::get('/logout', [UsersController::class, 'logout']);
});