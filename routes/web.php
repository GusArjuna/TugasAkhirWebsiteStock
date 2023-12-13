<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\displayer;
use App\Http\Controllers\KodeMaterialController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/login',[LoginController::class,'index'])->middleware('guest')->name('login');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout',[LoginController::class,'logout']);
Route::get('/regist',[RegisterController::class,'index'])->middleware('guest');
Route::post('/regist',[RegisterController::class,'store'])->middleware('guest');

Route::controller(displayer::class)->group(function () {
    Route::get('/', 'dashboard')->middleware('auth');
    Route::get('/stock', 'stok')->middleware('auth');
    Route::get('/print', 'pdfdashboard')->middleware('auth');
    Route::get('/stock/print', 'pdfstok')->middleware('auth');
    Route::post('/printdashboard', 'printdashboard')->middleware('auth');
    Route::post('/printstok', 'printstok')->middleware('auth');
    Route::post('/updatefsn', 'fsnupdate')->middleware('auth');
});

Route::controller(KodeMaterialController::class)->group(function () {
    Route::get('/code', 'index')->middleware('auth');
    Route::get('/code/datain', 'create')->middleware('auth');
    Route::post('/code/datain', 'store')->middleware('auth');
    Route::get('/code/{kodeMaterial}/editdata', 'edit')->middleware('auth');
    Route::post('/code/printdel', 'printdelete')->middleware('auth');
    // Route::delete('/code/{kodeMaterial}', 'destroy');
    Route::patch('/code/{kodeMaterial}', 'update')->middleware('auth');
});

Route::controller(BarangMasukController::class)->group(function () {
    Route::get('/stuffin', 'index')->middleware('auth');
    Route::get('/stuffin/datain', 'create')->middleware('auth');
    Route::post('/stuffin/datain', 'store')->middleware('auth');
    Route::get('/stuffin/{barangMasuk}/editdata', 'edit')->middleware('auth');
    Route::post('/stuffin/printdel', 'printdelete')->middleware('auth');
    // Route::get('/stuffin/print', 'pdf')->middleware('auth');
    // Route::delete('/stuffin/{barangMasuk}', 'destroy')->middleware('auth');
    Route::patch('/stuffin/{barangMasuk}', 'update')->middleware('auth');
});

Route::controller(BarangKeluarController::class)->group(function () {
    Route::get('/stuffout', 'index')->middleware('auth');
    Route::get('/stuffout/datain', 'create')->middleware('auth');
    Route::post('/stuffout/datain', 'store')->middleware('auth');
    Route::get('/stuffout/{barangKeluar}/editdata', 'edit')->middleware('auth');
    Route::post('/stuffout/printdel', 'printdelete')->middleware('auth');
    // Route::get('/stuffout/print', 'pdf')->middleware('auth');
    // Route::delete('/stuffout/{barangKeluar}', 'destroy')->middleware('auth');
    Route::patch('/stuffout/{barangKeluar}', 'update')->middleware('auth');
});