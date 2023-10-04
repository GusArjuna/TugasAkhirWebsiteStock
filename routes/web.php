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
    return view('home');
});

Route::get('/pricelist', function () {
    return view('pricelist');
});

Route::get('/stock', function () {
    return view('stock');
});

Route::get('/stuffin', function () {
    return view('stuffin');
});

Route::get('/stuffout', function () {
    return view('stuffout');
});
