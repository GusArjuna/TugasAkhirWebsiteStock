<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\displayer;
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


Route::controller(displayer::class)->group(function () {
    Route::get('/', 'dashboard');
    Route::get('/stock', 'stok');
    Route::get('/print', 'pdfdashboard');
    Route::get('/stock/print', 'pdfstok');
});

Route::controller(KodeMaterialController::class)->group(function () {
    Route::get('/code', 'index');
    Route::get('/code/datain', 'create');
    Route::post('/code/datain', 'store');
    Route::get('/code/{kodeMaterial}/editdata', 'edit');
    Route::get('/code/print', 'pdf');
    Route::delete('/code/{kodeMaterial}', 'destroy');
    Route::patch('/code/{kodeMaterial}', 'update');
});

Route::controller(BarangMasukController::class)->group(function () {
    Route::get('/stuffin', 'index');
    Route::get('/stuffin/datain', 'create');
    Route::post('/stuffin/datain', 'store');
    Route::get('/stuffin/{barangMasuk}/editdata', 'edit');
    Route::get('/stuffin/print', 'pdf');
    Route::delete('/stuffin/{barangMasuk}', 'destroy');
    Route::patch('/stuffin/{barangMasuk}', 'update');
});

Route::controller(BarangKeluarController::class)->group(function () {
    Route::get('/stuffout', 'index');
    Route::get('/stuffout/datain', 'create');
    Route::post('/stuffout/datain', 'store');
    Route::get('/stuffout/{barangKeluar}/editdata', 'edit');
    Route::get('/stuffout/print', 'pdf');
    Route::delete('/stuffout/{barangKeluar}', 'destroy');
    Route::patch('/stuffout/{barangKeluar}', 'update');
});