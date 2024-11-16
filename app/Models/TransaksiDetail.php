<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = "transaksi_detail";
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'subtotal',
        'qty'
    ];
     public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
