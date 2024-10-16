<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Models\transaksi;
use App\Http\Middleware\AuthUserMiddleware;
use Illuminate\Support\Facades\Route;

//login logout route
route::get('/', [Logincontroller::class,'index'])->name('login');
route::post('/authenticate', [Logincontroller::class,'authenticate'])->name('authenticate');
route::get('/logout', [Logincontroller::class,'logout'])->name('logout');

route::get('/app', [Homecontroller::class,'index'])->name('app');

//crud user



// route::get('/transaksi', [TransaksiController::class,'transaksi'])->name('transaksi/list');
// route::get('/pos', [DetailTransaksiController::class,'index'])->name('pos/list');
// route::get('/pos/create', [DetailTransaksiController::class,'create']);
// Route::post('/pos/store', [DetailTransaksiController::class, 'store'])->name('pos/store');

Route::middleware(['auth'])->group(function () {

    route::get('/user', [Usercontroller::class,'index'])->name('user/list');
    route::get('/user/create', [Usercontroller::class,'create']);
    route::post('/user/store', [Usercontroller::class,'store'])->name('user/store');
    route::post('/user/update/{id}', [Usercontroller::class,'update']);
    route::get('/user/destroy/{id}', [Usercontroller::class,'destroy']);

    //crud jenis barang
    route::get('/jenisbarang', [JenisBarangController::class,'index'])->name('jenisbarang/list');
    route::get('/jenisbarang/create', [JenisBarangController::class,'create']);
    route::post('/jenisbarang/store', [JenisBarangController::class,'store'])->name('jenisbarang/store');
    route::post('/jenisbarang/update/{id}', [JenisBarangController::class,'update']);
    route::get('/jenisbarang/destroy/{id}', [JenisBarangController::class,'destroy']);

    //cruud barang
    route::get('/barang', [BarangController::class,'index'])->name('barang/list');
    route::get('/addbarang', [BarangController::class,'addbarang'])->name('barang/add-barang');
    route::get('/editbarang/{id}', [BarangController::class,'edit']);
    route::post('/barang/store', [BarangController::class,'store'])->name('barang/store');
    route::post('/barang/update/{id}', [BarangController::class,'update']);
    route::get('/barang/destroy/{id}', [BarangController::class,'destroy']);

    route::get('/pos', [DetailTransaksiController::class,'index'])->name('pos/list');
    route::get('/pos/create', [DetailTransaksiController::class,'create']);
    Route::post('/pos/store', [DetailTransaksiController::class, 'store'])->name('pos/store');
    route::get('/transaksi', [TransaksiController::class,'transaksi'])->name('transaksi/list');
    route::get('/detail/{id}', [TransaksiController::class,'detail'])->name('detail/list');
    route::get('/cetak/{id}', [TransaksiController::class,'cetak'])->name('cetak/list');
    route::get('/transaksi/view/pdf/{id}', [TransaksiController::class,'view_pdf']);
    route::get('/transaksi/download/pdf/{id}', [TransaksiController::class,'donload_pdf']);
});





























































































