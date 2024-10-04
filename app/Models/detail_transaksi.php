<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class detail_transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal',
    ];
    protected $table = 'detail_transaksi';

    public function barang(): BelongsTo

    {
        return $this->belongsTo(barang::class, 'barang_id');
    }

    public function transaksi(): BelongsTo

    {
        return $this->belongsTo(transaksi::class);
    }

}
