<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KodeMaterialController;
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


Route::get('/stock', function () {
    return view('stock',["title" => "Stock"]);
});

Route::controller(KodeMaterialController::class)->group(function () {
    Route::get('/code', 'index');
    Route::get('/code/datain', 'create');
    Route::post('/code/datain', 'store');
    Route::get('/code/{kode}/editdata', 'edit');
    Route::post('/code/print', 'pdf');
    Route::delete('/code/{kode}', 'destroy');
    Route::patch('/code/{kode}', 'update');
});

Route::controller(BarangMasukController::class)->group(function () {
    Route::get('/stuffin', 'index');
    Route::get('/stuffin/datain', 'create');
    Route::post('/stuffin/datain', 'store');
    Route::get('/stuffin/{instuff}/editdata', 'edit');
    Route::post('/stuffin/print', 'pdf');
    Route::delete('/stuffin/{instuff}', 'destroy');
    Route::patch('/stuffin/{instuff}', 'update');
});

Route::controller(BarangKeluarController::class)->group(function () {
    Route::get('/stuffout', 'index');
    Route::get('/stuffout/datain', 'create');
    Route::post('/stuffout/datain', 'store');
    Route::get('/stuffout/{outstuff}/editdata', 'edit');
    Route::post('/stuffout/print', 'pdf');
    Route::delete('/stuffout/{outstuff}', 'destroy');
    Route::patch('/stuffout/{outstuff}', 'update');
});