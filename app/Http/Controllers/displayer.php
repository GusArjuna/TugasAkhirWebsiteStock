<?php

namespace App\Http\Controllers;

use App\Models\barangMasuk;
use App\Models\kodeMaterial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class displayer extends Controller
{
    public function pdfdashboard(){
        
        $kodematerials = kodeMaterial::all();
        $kodematerials = $kodematerials->toArray();
        $pdf = Pdf::loadView('pdfdashboard', ["kodematerials" => $kodematerials]);
        return $pdf->download('Kode_Material.pdf');
    }

    public function pdfstok(){
        
        $kodematerials = kodeMaterial::all();
        $kodematerials = $kodematerials->toArray();
        $pdf = Pdf::loadView('pdfstok', ["kodematerials" => $kodematerials]);
        return $pdf->download('Kode_Material.pdf');
    }

    public function dashboard()
    {
        $kodematerials = kodeMaterial::all();
        return view('home',[
            "title" => "Dashboard",
            "kodematerials" => $kodematerials,
        ]);
    }

    public function stok()
    {
        $kodematerials = kodeMaterial::all();
        return view('stock',[
            "title" => "Stock",
            "kodematerials" => $kodematerials,
        ]);
    }
}
