<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class jenisbarang extends Model
{   
    use HasFactory;
    protected $table = 'jenis_barang';
    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class);
    }

    protected $fillable = [
        'nama_jenis_barang',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

} 