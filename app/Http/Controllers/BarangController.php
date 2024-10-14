<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\jenisbarang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index() 
    {
        if (Auth::user()->role != 'admin') {
        return redirect('/')->with('error', 'Unauthorized access');
        }

        $title = 'Data - Barang';
        $title_table = 'Tabel Barang';
        $data_barang = Barang::with('jenisbarang')->get();     
        return view('admin.master.barang.list', compact('data_barang', 'title', 'title_table'));
    }   
    
    public function addBarang() 
    { 
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   

        $title = 'Tambah - Barang';
        $data_barang = jenisbarang::all();
        return view('admin.master.barang.add-barang', compact('data_barang', 'title'));
    }

    public function edit($id) 
    { 
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   
        $title = 'Update - Barang';
        $data_barang = Barang::with('jenisbarang')->find($id);
        $data_barang_jenis = jenisbarang::all();
        return view('admin.master.barang.update-barang', compact('data_barang', 'data_barang_jenis', 'title'));
    }   
    
    public function store(Request $request): RedirectResponse
    {   if (Auth::user()->role != 'admin') {
        return redirect('/')->with('error', 'Unauthorized access');
        }   
        //validate form
        $request->validate([
            // 'nama_barang'  => 'required|min:5',
            // 'harga'        => 'required|min:10',
            // 'foto'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            // 'stok'         => 'required|numeric',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products/', $image->hashName());

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
        // Check if the user is an admin
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   
    
        // Validate the form
        // $request->validate([
        //     'nama_barang'      => 'required|min:5',
        //     'jenis_barang_id'  => 'required|exists:jenis_barang,id',
        //     'harga'            => 'required|numeric',
        //     'stok'             => 'required|numeric',
        //     'image'            => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Image validation
        // ]);
    
        // Get the product by ID
        $barang = Barang::findOrFail($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
    
            // Upload the new image
            $image = $request->file('image');
            $image->storeAs('public/products/', $image->hashName());
    
            // Delete the old image from storage (if it exists)
            if ($barang->foto && Storage::exists('public/products/' . $barang->foto)) {
                Storage::delete('public/products/' . $barang->foto);
            }
    
            // Update the product with the new image
            $barang->update([
                'nama_barang'      => $request->nama_barang,
                'jenis_barang_id'  => $request->jenis_barang_id,
                'harga'            => $request->harga,
                'foto'             => $image->hashName(),
                'stok'             => $request->stok
            ]);
    
        } else {
    
            // Update the product without changing the image
            $barang->update([
                'nama_barang'      => $request->nama_barang,
                'jenis_barang_id'  => $request->jenis_barang_id,
                'harga'            => $request->harga,
                'stok'             => $request->stok
            ]);
        }
    
        return redirect()->route('barang/list')->with('success', 'Barang updated successfully');
    }
    

    public function destroy($id)
    {   if (Auth::user()->role != 'admin') {
        return redirect('/')->with('error', 'Unauthorized access');
        }   
        $barang = Barang::findOrFail($id);
        
        Storage::delete('/public/products/'. $barang->foto);
        $barang->delete();
        return redirect('barang')->with('success', 'Data Berhasil');
    }

}
