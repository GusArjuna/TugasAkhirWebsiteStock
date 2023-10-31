<?php

namespace App\Http\Controllers;

use App\Models\kodeMaterial;
use App\Http\Requests\StorekodeMaterialRequest;
use App\Http\Requests\UpdatekodeMaterialRequest;

class KodeMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kodematerials = kodeMaterial::all();
        return view('codestufff/codestuff',[
            "title" => "Kode Material",
            "kodematerials" => $kodematerials
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('codestufff/datain',["title" => "Data Kode Material"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekodeMaterialRequest $request)
    {
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'namaMaterial' => 'required',
            'satuan' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(kodeMaterial $kodeMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kodeMaterial $kodeMaterial)
    {
        return view('codestufff/dataedit',["title" => "Edit Data Kode Material"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekodeMaterialRequest $request, kodeMaterial $kodeMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kodeMaterial $kodeMaterial)
    {
        //
    }
}
