<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('login', LoginController::class);


Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');


Route::middleware(['isLogin', 'CekRole:Admin,Kasir'])->group(function () {
    Route::resource('dashboard', Controller::class);


    Route::resource('penjualan', PenjualanController::class);
    Route::get('/export/Excel/', [PenjualanController::class, 'exportExcel'])->name('export.Excel');
    Route::get('/penjualan/export/PDF/{id}', [PenjualanController::class, 'exportPDF'])->name('export.PDF');
    Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'detail'])->name('detail.penjualan');
    Route::get('/penjualan/invoice/{id}', [PenjualanController::class, 'invoice'])->name('invoice.penjualan');
    Route::patch('/penjualan/invoice/{id}/store', [PenjualanController::class, 'invoiceStore'])->name('invoice.store');

    Route::resource('produk', ProdukController::class);
    Route::get('/produk/{id}/editStock', [ProdukController::class,'editStock'])->name('produk.editStock');
    Route::patch('/produk/{id}/updateStock', [ProdukController::class, 'updateStock'])->name('produk.updateStock');
    Route::get('/trash/produk', [ProdukController::class,'trash'])->name('trash.produk');
    Route::post('/produk/trash/{id}/restore', [ProdukController::class,'restore'])->name('produk.restore');
    Route::post('/produk/trash/{id}/permanent', [ProdukController::class,'permanent'])->name('produk.permanent');
});

Route::middleware(['isLogin', 'CekRole:Admin'])->group( function () {
    Route::resource('user', UserController::class);
});