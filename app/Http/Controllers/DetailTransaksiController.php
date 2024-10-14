<?php

namespace App\Http\Controllers;
use App\Http\Middleware\AuthUserMiddleware;
use App\Models\barang;
use App\Models\User;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;  
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DetailTransaksiController extends Controller
{
    public function index()
    {   
        if (Auth::user()->role != 'operator') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   

        $title = 'Point of sale';
        $data_pos = barang::with('jenisbarang')->get();
        $data_transaksi = transaksi::with('user')->get();
        return view('operator.pos.pos', compact('data_pos', 'title', 'data_transaksi'));
    }

    public function store(Request $request)
{
    // Cek apakah user adalah operator
    if (Auth::user()->role != 'operator') {
        return redirect('/')->with('error', 'Unauthorized access');
    }

    // Ambil ID user yang sedang login
    $userId = Auth::id();

    // Mulai transaksi database
    DB::beginTransaction();

    try {
        // Simpan data ke tabel transaksi
        $transaksi = transaksi::create([
            'tgl_transaksi' => now(),
            'user_id' => $userId,
            'total_bayar' => $request->input('total'),
            'pembayaran_cs' => str_replace('.', '', $request->input('bayar')),  // Menghilangkan titik pada pembayaran_cs
            'kembalian_cs' => $request->input('kembalian'),
        ]);

        // Simpan data ke tabel detail_transaksi dan kurangi stok barang
        foreach ($request->input('items') as $item) {
            // Cari barang berdasarkan ID
            $barang = Barang::find($item['id']);

            // Cek apakah barang ditemukan dan stok mencukupi
            if ($barang && $barang->stok >= $item['qty']) {
                // Kurangi stok barang
                $barang->stok -= $item['qty'];
                $barang->save(); // Simpan perubahan stok

                // Simpan detail transaksi
                detail_transaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['id'], // Pastikan ID barang digunakan
                    'qty' => $item['qty'],
                    'harga' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            } else {
                // Jika stok tidak mencukupi, rollback dan kirim error
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi untuk barang: ' . $barang->nama_barang
                ], 400);
            }
        }

        // Jika semua berhasil, commit transaksi database
        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan!',
            'transaksi' => $transaksi,
        ]);

    } catch (\Exception $e) {
        // Rollback jika terjadi kesalahan
        DB::rollBack();
        return response()->json([
            'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
        ], 500);
    }
}

}

