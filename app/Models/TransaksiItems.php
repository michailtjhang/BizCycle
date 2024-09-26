<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItems extends Model
{
    use HasFactory;

    protected $table = 'transaksi_items';

    protected $fillable = [
        'transaksi_id', 
        'id_dTransaksi', 
        'nama', 
        'harga', 
        'quantity'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
