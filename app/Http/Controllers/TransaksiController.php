<?php

namespace App\Http\Controllers;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use App\Models\Barang;
use App\Models\jenisbarang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksi() 
    { 
        $title = 'Transaksi';
        $title_table = 'Data - Transaksi';
        $data_transaksi = transaksi::with('detail_transaksi')->get();
        return view('operator.transaksi.transaksi', compact('data_transaksi', 'title', 'title_table'));
    }  
    public function detail($id) 
    { 
        $title = 'Detail - Transaksi';
        $title_table = 'Data - Detail Transaksi';
        $data_detail = transaksi::with('detail_transaksi')->find($id);
        return view('operator.transaksi.detail', compact('data_detail', 'title', 'title_table'));
    }   

    // public function transaksi()
    // {
    //     $title = 'Data - Transaksi';
    //     $title_detail = 'Data - detail Transaksi';
    //     $title_transaksi = 'Data - Transaksi';
    //     $data_detail_transaksi = Barang::all();
    //     return view('operator.transaksi.transaksi', compact('data_detail_transaksi', 'title_detail', 'title', 'title_transaksi'));
    // } 
    



    
    
    // public function addBarang() 
    // { 
    //     $title = 'Tambah - Barang';
    //     $data_barang = transaksi::all();
    //     return view('admin.master.barang.add-barang', compact('data_barang', 'title'));
    // }

    // public function edit($id) 
    // { 
    //    $title = 'Update - Barang';
    //    $data_barang = transaksi::with('jenisbarang')->find($id);
    //    $data_barang_jenis = transaksi:all();
    //     return view('admin.master.barang.update-barang', compact('data_barang', 'data_barang_jenis', 'title'));
    // }   
    
}
