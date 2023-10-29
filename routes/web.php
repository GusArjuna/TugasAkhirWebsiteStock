<?php

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

Route::get('/', function () {
    return view('home',["title" => "Dashboard"]);
});

Route::get('/pricelist', function () {
    return view('pricelist',["title" => "Pricelist"]);
});

Route::get('/stock', function () {
    return view('stock',["title" => "Stock"]);
});

Route::get('/stuffinf/stuffin', function () {
    return view('stuffinf/stuffin',["title" => "Barang Masuk"]);
});

Route::get('/stuffoutf/stuffout', function () {
    return view('stuffoutf/stuffout',["title" => "Barang Keluar"]);
});
