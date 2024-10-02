<?php

namespace Database\Seeders;

use App\Models\jenisbarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       jenisbarang::create(['nama_jenis_barang' => 'Baut']);
       jenisbarang::create(['nama_jenis_barang' => 'knalpot']);
       jenisbarang::create(['nama_jenis_barang' => 'master rem']);
       jenisbarang::create(['nama_jenis_barang' => 'Oli samping']);
       jenisbarang::create(['nama_jenis_barang' => 'Kaliper']);
       jenisbarang::create(['nama_jenis_barang' => 'Veleg']);
       jenisbarang::create(['nama_jenis_barang' => 'Ban']);
       
    }
}
