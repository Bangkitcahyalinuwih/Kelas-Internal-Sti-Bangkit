<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\jenisbarang;

class JenisBarangController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Jenis Barang',
            'data_jenis' => jenisbarang::all()
        );
        return view('admin.master.jenisbarang.list', $data);
    }

    public function store(Request $request)
    {
        jenisbarang::create([
            'nama_jenis_barang' => $request->nama_jenis_barang,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil disimpan');
    }
    
    public function update(Request $request, $id)
    {
        jenisbarang::where('id', $id)
        ->where('id', $id)
        ->update([
            'nama_jenis_barang' => $request->nama_jenis_barang,
        ]);
        return redirect('/jenis_barang')->with('success', 'Data Berhasil diupdate');
    }

    public function destroy($id)
    {
        jenisbarang::where('id', $id)->delete();
        return redirect('/jenis_barang')->with('success', 'Data Berhasil dihapus');
    }

}
