<?php

namespace App\Http\Controllers;

use App\Models\barangMasuk;
use App\Http\Requests\StorebarangMasukRequest;
use App\Http\Requests\UpdatebarangMasukRequest;
use App\Models\kodeMaterial;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kodematerials = kodeMaterial::all();
        $barangmasuks = barangMasuk::all();
        return view('stuffinf/stuffin',[
            "title" => "Barang Keluar",
            "barangmasuks" => $barangmasuks,
            "kodematerials" => $kodematerials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stuffinf/datain',["title" => "Data Barang Masuk"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebarangMasukRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(barangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barangMasuk $barangMasuk)
    {
        return view('stuffinf/dataedit',["title" => "Edit Data Barang Masuk"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangMasukRequest $request, barangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barangMasuk $barangMasuk)
    {
        //
    }
}
