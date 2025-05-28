<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ListProdukController;

Route::get('/listproduk', [ListProdukController::class, 'show'] );
Route::post('/listproduk', [ListProdukController::class, 'simpan'])->name('produk.simpan');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('pages.home');
});