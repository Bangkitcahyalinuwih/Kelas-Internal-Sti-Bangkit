<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class jenisbarang extends Model
{   
    use HasFactory;
    protected $fillable = [
        'nama_jenis_barang',
    ];

    protected $table = 'jenis_barang';
    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
} 