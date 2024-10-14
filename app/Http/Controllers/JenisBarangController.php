<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;
use Illuminate\Support\Facades\Auth;

class JenisBarangController extends Controller
{
    public function index() 
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   

        $title = 'Data Jenis-Barang';
        $table_title = 'Table Jenis-Barang';
        $data_jenis_barang = JenisBarang::all();
        return view('admin.master.jenisbarang.list', compact('title', 'data_jenis_barang', 'table_title'));
    }   

    public function store(Request $request)
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   
        JenisBarang::create([
            'nama_jenis_barang' => $request->nama_jenis_barang,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }   

    public function update(Request $request, $id)
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   
        JenisBarang::where('id', $id)->where('id', $id)->update([
            'nama_jenis_barang' => $request->nama_jenis_barang,
        ]);
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }

    public function destroy($id)
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   
        JenisBarang::where('id', $id)->delete();
        return redirect('/jenisbarang')->with('success', 'Data Berhasil');
    }

}
