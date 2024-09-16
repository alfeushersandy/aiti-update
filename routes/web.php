<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\SerahController;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/barang/generate', [BarangController::class, 'downloadPdf'])->name('barang.generate');
Route::get('/serah/cetak', [SerahController::class, 'cetakPdf'])->name('serah.cetak');
