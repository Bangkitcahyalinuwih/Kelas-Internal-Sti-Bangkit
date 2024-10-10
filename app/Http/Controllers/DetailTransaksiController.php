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
        $title = 'Point of sale';
        $data_pos = barang::with('jenisbarang')->get();
        $data_transaksi = transaksi::with('user')->get();
        return view('operator.pos.pos', compact('data_pos', 'title', 'data_transaksi'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'date' => 'required|date',
        //     'bayar' => 'required|numeric',
        //     'total' => 'required|numeric',
        //     'kembalian' => 'required|numeric',
        //     'items' => 'required|array',
        //     'items.*.id' => 'required|exists:barang,id', // Pastikan ID barang ada di tabel
        //     'items.*.qty' => 'required|integer|min:1', // Minimal qty 1
        //     'items.*.harga_satuan' => 'required|numeric',
        //     'items.*.subtotal' => 'required|numeric',
        // ]);

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
              'pembayaran_cs' => str_replace('.', '', $request->input('bayar')),      // Menghilangkan titik pada pembayaran_cs
                'kembalian_cs' => $request->input('kembalian'),
            ]);

            //Simpan data ke tabel detail_transaksi
            foreach ($request->input('items') as $item) {
                detail_transaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['id'], // Pastikan ID barang digunakan
                    'qty' => $item['qty'],
                    'harga' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            }
        
            DB::commit();
        
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'transaksi' => $transaksi,
            ]);
        
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }
}

