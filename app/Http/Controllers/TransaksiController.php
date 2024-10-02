<?php

namespace App\Http\Controllers;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() 
    { 
       $title = 'Detail - Transaksi';
       $title_table = 'Data - Transaksi';
       $data_transaksi = detail_transaksi::all();
           
        return view('operator.detailtransaksi.list', compact('data_transaksi', 'title', 'title_table'));
    }   

    public function pos()
    {
        $title = 'Pos - Transaksi';
        $title_table = 'Data - Transaksi';
        $data_transaksi = Barang::all();
        return view('operator.transaksi.pos', compact('data_transaksi', 'title', 'title_table'));
    }

    
    
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
