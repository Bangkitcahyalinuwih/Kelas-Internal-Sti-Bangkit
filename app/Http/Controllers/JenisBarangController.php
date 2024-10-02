<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;


class JenisBarangController extends Controller
{
    public function index() 
    { 
        $title = 'Data Jenis-Barang';
        $table_title = 'Table Jenis-Barang';
        $data_jenis_barang = JenisBarang::all();
        return view('admin.master.jenisbarang.list', compact('title', 'data_jenis_barang', 'table_title'));
    }   

    public function store(Request $request)
    {
        JenisBarang::create([
            'nama_jenis_barang' => $request->nama_jenis_barang,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }   

    public function update(Request $request, $id)
    {
        JenisBarang::where('id', $id)->where('id', $id)->update([
            'nama_jenis_barang' => $request->nama_jenis_barang,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {   
        JenisBarang::where('id', $id)->delete();
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }

}
