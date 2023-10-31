<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Http\Requests\StorebarangKeluarRequest;
use App\Http\Requests\UpdatebarangKeluarRequest;
use App\Models\kodeMaterial;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangKeluarController extends Controller
{
    public function pdf(){
        
        $kodematerials = kodeMaterial::all();
        $kodematerials = $kodematerials->toArray();
        $barangkeluars = barangKeluar::all();
        $barangkeluars = $barangkeluars->toArray();
        $pdf = Pdf::loadView('stuffoutf.pdf', [
            "kodematerials" => $kodematerials,
            "barangkeluars" => $barangkeluars
        ]);
        return $pdf->download('Laporan_Barang_Masuk.pdf');
    }
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
        $kodematerials = kodeMaterial::all();
        return view('stuffoutf/datain',[
            "title" => "Data Barang Keluar",
            "kodematerials" => $kodematerials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebarangKeluarRequest $request)
    {
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'peruntukan' => 'required',
            'keperluan' => 'required',
            'keterangan' => 'required',
            'tanggalKeluar' => 'required',
        ]);

        barangKeluar::create($validatedData);
        return redirect('/stuffout')->with('success','Data Ditambahkan');
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
        $kodematerials = kodeMaterial::all();
        return view('stuffoutf/dataedit',[
            "title" => "Edit Data Barang Keluar",
            "barangKeluar" => $barangKeluar,
            "kodematerials" => $kodematerials
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangKeluarRequest $request, barangKeluar $barangKeluar)
    {
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'peruntukan' => 'required',
            'keperluan' => 'required',
            'keterangan' => 'required',
            'tanggalKeluar' => 'required',
        ]);

        barangKeluar::where('id',$barangKeluar->id)
                    ->update($validatedData);
        return redirect('/stuffout')->with('success','Data diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barangKeluar $barangKeluar)
    {
        barangKeluar::destroy($barangKeluar->id);
        return redirect('/stuffout')->with('success','Data Dihapus');
    }
}
