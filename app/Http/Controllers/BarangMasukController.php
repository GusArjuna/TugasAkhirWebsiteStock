<?php

namespace App\Http\Controllers;

use App\Models\barangMasuk;
use App\Http\Requests\StorebarangMasukRequest;
use App\Http\Requests\UpdatebarangMasukRequest;
use App\Models\kodeMaterial;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangMasukController extends Controller
{
    public function pdf(){
        
        $kodematerials = kodeMaterial::all();
        $kodematerials = $kodematerials->toArray();
        $barangmasuks = barangMasuk::all();
        $barangmasuks = $barangmasuks->toArray();
        $pdf = Pdf::loadView('stuffinf.pdf', [
            "kodematerials" => $kodematerials,
            "barangmasuks" => $barangmasuks
        ]);
        return $pdf->download('Laporan_Barang_Masuk.pdf');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kodematerials = kodeMaterial::all();
        $barangmasuks = barangMasuk::all();
        return view('stuffinf/stuffin',[
            "title" => "Barang Masuk",
            "barangmasuks" => $barangmasuks,
            "kodematerials" => $kodematerials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kodematerials = kodeMaterial::all();
        return view('stuffinf/datain',[
            "title" => "Data Barang Masuk",
            "kodematerials" => $kodematerials
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebarangMasukRequest $request)
    {
        $kodematerial=kodeMaterial::where('kodeMaterial', $request->kodeMaterial)->first();
        $kodematerial->stok = $kodematerial->stok + $request->jumlah;
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'tanggalMasuk' => 'required',
        ]);
        kodeMaterial::where('kodeMaterial', $request->kodeMaterial)
                    ->update(['stok' => $kodematerial->stok]);
        barangMasuk::create($validatedData);
        return redirect('/stuffin')->with('success','Data Ditambahkan');
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
        $kodematerials = kodeMaterial::all();
        return view('stuffinf/dataedit',[
            "title" => "Edit Data Barang Masuk",
            "barangMasuk" => $barangMasuk,
            "kodematerials" => $kodematerials
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebarangMasukRequest $request, barangMasuk $barangMasuk)
    {
        $kodematerial=kodeMaterial::where('kodeMaterial', $request->kodeMaterial)->first();
        if ($request->jumlah>$barangMasuk->jumlah) {
            $perubahan = $request->jumlah - $barangMasuk->jumlah;
        }elseif ($request->jumlah<$barangMasuk->jumlah) {
            $perubahan = $request->jumlah - $barangMasuk->jumlah;
        }else{
            $perubahan = 0;
        }
        $kodematerial->stok = $kodematerial->stok + $perubahan;
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'tanggalMasuk' => 'required',
        ]);
        kodeMaterial::where('kodeMaterial', $request->kodeMaterial)
                    ->update(['stok' => $kodematerial->stok]);
        barangMasuk::where('id',$barangMasuk->id)
                    ->update($validatedData);
        return redirect('/stuffin')->with('success','Data Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barangMasuk $barangMasuk)
    {
        $kodematerial=kodeMaterial::where('kodeMaterial', $barangMasuk->kodeMaterial)->first();
        $kodematerial->stok = $kodematerial->stok - $barangMasuk->jumlah;
        kodeMaterial::where('kodeMaterial', $barangMasuk->kodeMaterial)
                    ->update(['stok' => $kodematerial->stok]);
        barangMasuk::destroy($barangMasuk->id);
        return redirect('/stuffin')->with('success','Data Dihapus');
    }
}
