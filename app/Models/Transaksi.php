<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $fillable = [
        'user_id',
        'pembayaran_id',
        'total',
        'no_transaksi',
        'dibayarkan'
    ];
    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
    public function barang()
    {
        return $this->hasMany(barang::class);
    }
    public function jns_pembayaran()
    {
        return $this->hasOne(JenisPembayaran::class, 'pembayaran_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
