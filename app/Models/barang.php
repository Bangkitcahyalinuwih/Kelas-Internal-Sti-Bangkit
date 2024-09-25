<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    public function jenis_barang(): BelongsTo
    {
        return $this->belongsTo(jenis_barang::class);
    }

    public function detail_transaksi(): HasMany
    {
        return $this->hasMany(detail_transaksi::class);
    }
}
