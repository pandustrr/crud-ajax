<?php

use App\Http\Controllers\BahanMakananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('bahan-makanan.index');
});

Route::resource('bahan-makanan', BahanMakananController::class);
Route::get('bahan-makanan/hapus/{id}', [BahanMakananController::class, 'destroy'])->name('bahan-makanan.hapus');
