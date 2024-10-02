<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_barang',
        'jenis_barang_id',
        'harga',
        'foto',
        'stok',
    ];

    protected $table = 'barang';

    public function jenisbarang(): BelongsTo
    {
        return $this->belongsTo(jenisbarang::class, 'jenis_barang_id');
    }

    public function detail_transaksi(): HasMany
    {
        return $this->hasMany(detail_transaksi::class);
    }
}
