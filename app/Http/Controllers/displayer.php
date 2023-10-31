<?php

namespace App\Http\Controllers;

use App\Models\barangMasuk;
use App\Models\kodeMaterial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class displayer extends Controller
{
    public function pdfdashboard(){
        
        $collection = kodeMaterial::all();
        $data = $collection->toArray();
        $pdf = Pdf::loadView('codestufff.pdf', ["data" => $data]);
        return $pdf->download('Kode_Material.pdf');
    }

    public function pdfstok(){
        
        $collection = kodeMaterial::all();
        $data = $collection->toArray();
        $pdf = Pdf::loadView('codestufff.pdf', ["data" => $data]);
        return $pdf->download('Kode_Material.pdf');
    }

    public function dashboard()
    {
        $kodematerials = kodeMaterial::all();
        $barangmasuks = barangMasuk::all();
        return view('stuffinf/stuffin',[
            "title" => "Dashboard",
            "barangmasuks" => $barangmasuks,
            "kodematerials" => $kodematerials,
        ]);
    }

    public function stok()
    {
        $kodematerials = kodeMaterial::all();
        $barangmasuks = barangMasuk::all();
        return view('stuffinf/stuffin',[
            "title" => "Stock",
            "barangmasuks" => $barangmasuks,
            "kodematerials" => $kodematerials,
        ]);
    }
}
