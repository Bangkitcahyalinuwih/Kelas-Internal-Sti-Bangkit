<?php

namespace App\Http\Controllers;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use App\Models\Barang;
use App\Models\jenisbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{   
    public function transaksi() 
    {
        if (Auth::user()->role != 'operator') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   
        
        $title = 'Transaksi';
        $title_table = 'Data - Transaksi';
        $data_transaksi = transaksi::with('detail_transaksi')->get();
        return view('operator.transaksi.transaksi', compact('data_transaksi', 'title', 'title_table'));
    }  
    public function detail($id) 
    { 
        if (Auth::user()->role != 'operator') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   
        $title = 'Detail - Transaksi';
        $title_table = 'Data - Detail Transaksi';
        $data_detail = transaksi::with('detail_transaksi')->find($id);
        return view('operator.transaksi.detail', compact('data_detail', 'title', 'title_table'));
    }   

    public function cetak($id)
    {   
        if (Auth::user()->role != 'operator') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   
        $title = 'Sperpat';
        $data_cetak = transaksi::with('detail_transaksi')->find($id);
        return view('operator.transaksi.cetak', compact('title', 'data_cetak'));
    }

    public function view_pdf($id)
    {   
        if (Auth::user()->role != 'operator') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   
        $mpdf = new \Mpdf\Mpdf();
        $data_cetak = transaksi::with('detail_transaksi')->find($id);
        $mpdf->WriteHTML(view('operator.transaksi.cetak', compact('data_cetak')));
        $mpdf->Output();
    }

    public function donload_pdf($id)
    {    if (Auth::user()->role != 'operator') {
        return redirect('/')->with('error', 'Unauthorized access');
        }   

        $mpdf = new \Mpdf\Mpdf();
        $data_cetak = transaksi::with('detail_transaksi')->find($id);
        $mpdf->WriteHTML(view('operator.transaksi.cetak', compact('data_cetak')));
        $mpdf->Output('download-pdf','D');
    }
    
    
}
