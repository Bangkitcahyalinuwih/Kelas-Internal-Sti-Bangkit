<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



//login logout route

route::get('/', [Logincontroller::class,'index'])->name('login');
route::post('/authenticate', [Logincontroller::class,'authenticate'])->name('authenticate');
route::get('/logout', [Logincontroller::class,'logout'])->name('logout');

route::get('/app', [Homecontroller::class,'index'])->name('app');

//route::get('/jenisbarang', [JenisBarangController::class,'index'])->name('master/jenisbarang/list');

    //crud user
route::get('/user', [Usercontroller::class,'index'])->name('user/list');
route::post('/user/store', [Usercontroller::class,'store'])->name('user/store');
route::post('/user/update/{id}', [Usercontroller::class,'update']);
route::get('/user/destroy/{id}', [Usercontroller::class,'destroy']);


