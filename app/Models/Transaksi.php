<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'id_transaksi',
        'user_id',
        'total_harga',
        'total_diskon',
        'tgl_beli'
    ];

    public function items()
    {
        return $this->hasMany(TransaksiItems::class, 'transaksi_id', 'id_transaksi');
    }
}
