<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_transaksi',
        'user_id',
        'total_bayar',
        'pembayaran_cs',
        'kembalian_cs',
    ];
    protected $table = 'transaksi';

    public function detail_transaksi(): HasMany
    {
        return $this->hasMany(detail_transaksi::class, 'transaksi_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
