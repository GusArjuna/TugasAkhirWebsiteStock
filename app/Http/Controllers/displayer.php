<?php

namespace App\Http\Controllers;

use App\Models\fsntable;
use App\Models\kodeMaterial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class displayer extends Controller
{
    public function fsnupdate(){
        // Hapus data hanya sekali (biasanya ini dijalankan sekali saja, bukan setiap saat)
        fsntable::truncate();

        // Memperoleh data dan mengurutkannya berdasarkan 'frekuensi'
        $frekuensifsns = kodeMaterial::orderByDesc('frekuensi')->get();
        $loping = 1;
        foreach ($frekuensifsns as $frekuensifsn) {
            fsntable::create([
                'kodeMaterial' => $frekuensifsn->kodeMaterial, 
                'namaMaterial' => $frekuensifsn->namaMaterial,
                'peruntukan' => $frekuensifsn->peruntukan,
                'satuan' => $frekuensifsn->satuan,
                'lokasi' => 'RAK ' . $loping,
            ]);
            $loping = $loping + 1;
        }
        return redirect('/')->with('success','Data DiUpdate');

    }

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
        $fsn = fsntable::paginate(10);
        return view('home',[
            "title" => "Dashboard",
            "fsns" => $fsn,
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
            $cek=false;
            $lastId = kodeMaterial::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            for ($i = 1; $i <= $lastId; $i++) {
                $inputName = 'print' . $i;
                if($request->$inputName){
                    $cek=true;
                    break;
                }elseif(!$request->$inputName){
                    $cek=false;
                }
            }
            if($cek){
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
            }else{
            $data = kodeMaterial::all();
            $data = $data->toArray();
            $pdf = Pdf::loadView('pdfstok', ["kodematerials" => $data,]);
            return $pdf->download('Laporan_Rak.pdf');
            }   
        }        
    }

    public function printdashboard(Request $request)
    {   
        if($request->generate){
            $cek=false;
            $lastId = fsntable::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            for ($i = 1; $i <= $lastId; $i++) {
                $inputName = 'print' . $i;
                if($request->$inputName){
                    $cek=true;
                    break;
                }elseif(!$request->$inputName){
                    $cek=false;
                }
            }
            if($cek){
                for ($i = 1; $i <= $lastId; $i++) {
                    $inputName = 'print' . $i; // Membuat nama input berdasarkan iterasi

                    if ($request->has($inputName)) {
                        // Melakukan pencarian berdasarkan nilai input dari request pada model fsntable
                        $foundMaterial = fsntable::find($request->$inputName);

                        if ($foundMaterial) {
                            $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                        }
                    }
                }
                $pdf = Pdf::loadView('pdfdashboard', [
                    "fsns" => $data,
                ]);
                return $pdf->download('Laporan_Rak.pdf');
            }else{
            $fsns = fsntable::all();
            $fsns = $fsns->toArray();
            $pdf = Pdf::loadView('pdfdashboard', ["fsns" => $fsns]);
            return $pdf->download('Laporan_Rak.pdf');
            }   
        }
    }
}
