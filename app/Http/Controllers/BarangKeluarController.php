<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Http\Requests\StorebarangKeluarRequest;
use App\Http\Requests\UpdatebarangKeluarRequest;
use App\Models\kodeMaterial;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kodematerials = kodeMaterial::all();
        $barangkeluars = barangKeluar::all();
        return view('stuffoutf/stuffout',[
            "title" => "Barang Keluar",
            "barangkeluars" => $barangkeluars,
            "kodematerials" => $kodematerials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stuffoutf/datain',["title" => "Data Barang Keluar"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebarangKeluarRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(barangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barangKeluar $barangKeluar)
    {
        return view('stuffoutf/dataedit',["title" => "Edit Data Barang Keluar"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangKeluarRequest $request, barangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barangKeluar $barangKeluar)
    {
        //
    }
}
