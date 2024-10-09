<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function pos()
    {
        $title = 'Point of sale';
        $data_pos = barang::with('jenisbarang')->get();
        $data_transaksi = transaksi::with('user')->get();
        return view('operator.pos.pos', compact('data_pos', 'title', 'data_transaksi'));
    }

    public function store(Request $request)
    {
        dd($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi berhasil ditambahkan',
        ]);
    }
}
