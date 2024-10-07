<?php

namespace App\Http\Controllers;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use App\Models\Barang;
use App\Models\jenisbarang;
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

    public function transaksi()
    {
        $title = 'Data - Transaksi';
        $title_detail = 'Data - detail Transaksi';
        $title_transaksi = 'Data - Transaksi';
        $data_detail_transaksi = Barang::all();
        return view('operator.transaksi.transaksi', compact('data_detail_transaksi', 'title_detail', 'title', 'title_transaksi'));
    } 
    public function pos()
    {
        $title = 'Point of sale';
        $data_pos = Barang::with('jenisbarang')->get();
        return view('operator.pos.pos', compact('data_pos', 'title'));
    }

   public function store(Request $request)
    {
        dd($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data transaksi berhasil ditambahkan',
        ]);
    }

    public function filter(Request $request)
    {
        $query = jenisbarang::query();

        // Filter berdasarkan pilihan
        if ($request->filled('filter_option')) {
            $query->where('jenis_barang_id', $request->filter_option);
        }

        $data = $query->get();
        return view('filter', compact('data'));
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
