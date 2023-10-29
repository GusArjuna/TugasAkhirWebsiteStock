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


Route::get('/stock', function () {
    return view('stock',["title" => "Stock"]);
});

Route::get('/code', function () {
    return view('codestufff/codestuff',["title" => "Kode Material"]);
});

Route::get('/code/datain', function () {
    return view('codestufff/datain',["title" => "Data Kode Material"]);
});

Route::get('/code/editdata', function () {
    return view('codestufff/dataedit',["title" => "Edit Data Kode Material"]);
});

Route::get('/stuffin', function () {
    return view('stuffinf/stuffin',["title" => "Barang Masuk"]);
});

Route::get('/stuffin/datain', function () {
    return view('stuffinf/datain',["title" => "Data Barang Masuk"]);
});

Route::get('/stuffin/editdata', function () {
    return view('stuffinf/dataedit',["title" => "Edit Data Barang Masuk"]);
});

Route::get('/stuffout', function () {
    return view('stuffoutf/stuffout',["title" => "Barang Keluar"]);
});

Route::get('/stuffout/datain', function () {
    return view('stuffout/datain',["title" => "Data Barang Keluar"]);
});

Route::get('/stuffout/editdata', function () {
    return view('stuffoutf/dataedit',["title" => "Edit Data Barang Keluar"]);
});
// Route::controller(InstuffController::class)->group(function () {
//     Route::get('/stuffin', 'index')->middleware('auth');
//     Route::get('/stuffin/formin', 'create')->middleware('auth');
//     Route::post('/stuffin/formin', 'store')->middleware('auth');
//     Route::get('/stuffin/{instuff}/edit', 'edit')->middleware('auth');
//     Route::post('/stuffin/print', 'pdf')->middleware('auth');
//     Route::delete('/stuffin/{instuff}', 'destroy')->middleware('auth');
//     Route::patch('/stuffin/{instuff}', 'update')->middleware('auth');
// });
// Route::controller(OutstuffController::class)->group(function () {
//     Route::get('/stuffout', 'index')->middleware('auth');
//     Route::get('/stuffout/formout', 'create')->middleware('auth');
//     Route::post('/stuffout/formout', 'store')->middleware('auth');
//     Route::get('/stuffout/{outstuff}/edit', 'edit')->middleware('auth');
//     Route::post('/stuffout/print', 'pdf')->middleware('auth');
//     Route::delete('/stuffout/{outstuff}', 'destroy')->middleware('auth');
//     Route::patch('/stuffout/{outstuff}', 'update')->middleware('auth');
// });