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
        'total'
    ];
    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
