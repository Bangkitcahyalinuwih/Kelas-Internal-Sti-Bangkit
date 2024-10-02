<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\jenisbarang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index() 
    { 
        $title = 'Data - Barang';
        $title_table = 'Tabel Barang';
        $data_barang = Barang::with('jenisbarang')->get();    
        return view('admin.master.barang.list', compact('data_barang', 'title', 'title_table'));
    }   
    
    public function addBarang() 
    { 
        $title = 'Tambah - Barang';
        $data_barang = jenisbarang::all();
        return view('admin.master.barang.add-barang', compact('data_barang', 'title'));
    }

    public function edit($id) 
    { 
        $title = 'Update - Barang';
        $data_barang = Barang::with('jenisbarang')->find($id);
        $data_barang_jenis = jenisbarang::all();
        return view('admin.master.barang.update-barang', compact('data_barang', 'data_barang_jenis', 'title'));
    }   
    
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            // 'nama_barang'  => 'required|min:5',
            // 'harga'        => 'required|min:10',
            // 'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            // 'stok'         => 'required|numeric',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        $format_harga = str_replace('.', '', $request->harga);
        //create product
        Barang::create([
            'nama_barang'  => $request->nama_barang,
            'jenis_barang_id'  => $request->jenis_barang_id,
            'harga'        => $format_harga,
            'foto'         => $image->hashName(),
            'stok'         => $request->stok
        ]);

        //redirect to index
        return redirect()->route('barang/list')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            // 'title'         => 'required|min:5',
            // 'description'   => 'required|min:10',
            // 'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            // 'price'         => 'required|numeric',
            // 'stock'         => 'required|numeric'
        ]);

        //get product by ID
        $barang = Barang::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products'.$barang->image);

            //update product with new image
            $barang->update([
                'nama_barang'         => $request->nama_barang,
                'jenis_barang_id'   => $request->jenis_barang_id,
                'harga'         => $request->harga,
                'foto'         => $image->hashName(),
                'stok'         => $request->stok
            ]);

        } else {

            //update product without image
            $barang->update([
                'nama_barang'         => $request->nama_barang,
                'jenis_barang_id'   => $request->jenis_barang_id,
                'harga'         => $request->harga,
                'stok'         => $request->stok
            ]);
        }

        //redirect to index
        return redirect()->route('barang/list')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {   
        $barang = Barang::findOrFail($id);
        
        Storage::delete('/public/products/'. $barang->foto);
        $barang->delete();
        return redirect('barang')->with('success', 'Data Berhasil');
    }

}
