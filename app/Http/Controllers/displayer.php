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
        $kodematerials = kodeMaterial::paginate(10);
        return view('home',[
            "title" => "Dashboard",
            "kodematerials" => $kodematerials,
        ]);
    }

    public function stok()
    {
        $kodematerials = kodeMaterial::paginate(10);
        return view('stock',[
            "title" => "Stock",
            "kodematerials" => $kodematerials,
        ]);
    }

    public function printstok(Request $request)
    {   
        if($request->generate){
            $lastId = kodeMaterial::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            for ($i = 1; $i <= $lastId; $i++) {
                $inputName = 'print' . $i; // Membuat nama input berdasarkan iterasi

                if ($request->has($inputName)) {
                    // Melakukan pencarian berdasarkan nilai input dari request pada model kodeMaterial
                    $foundMaterial = kodeMaterial::find($request->$inputName);

                    if ($foundMaterial) {
                        $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                    }
                }
            }
            $pdf = Pdf::loadView('pdfstok', [
                "kodematerials" => $data,
            ]);
            return $pdf->download('Laporan_Stok.pdf');
        }
        
    }

    public function printdashboard(Request $request)
    {   
        if($request->generate){
            $lastId = kodeMaterial::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            for ($i = 1; $i <= $lastId; $i++) {
                $inputName = 'print' . $i; // Membuat nama input berdasarkan iterasi

                if ($request->has($inputName)) {
                    // Melakukan pencarian berdasarkan nilai input dari request pada model kodeMaterial
                    $foundMaterial = kodeMaterial::find($request->$inputName);

                    if ($foundMaterial) {
                        $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                    }
                }
            }
            $pdf = Pdf::loadView('pdfdashboard', [
                "kodematerials" => $data,
            ]);
            return $pdf->download('Laporan_Rak.pdf');
        }
        
    }
}
