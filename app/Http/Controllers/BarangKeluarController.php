<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Http\Requests\StorebarangKeluarRequest;
use App\Http\Requests\UpdatebarangKeluarRequest;
use App\Models\kodeMaterial;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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
        $barangkeluars = barangKeluar::query();
        if(request('search')){
            $querytambahans=kodeMaterial::where('peruntukan','like','%'.request('search').'%')
                                        ->orWhere('namaMaterial','like','%'.request('search').'%')
                                        ->orWhere('satuan','like','%'.request('search').'%')->get();
                                        
            $barangkeluars->where('kodeMaterial','like','%'.request('search').'%')
                                        ->orWhere('jumlah','like','%'.request('search').'%')
                                        ->orWhere('kondisi','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%')
                                        ->orWhere('keperluan','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%')
                                        ->orWhere('peminjam','like','%'.request('search').'%')
                                        ->orWhere('divisi','like','%'.request('search').'%')
                                        ->orWhere('tanggalKeluar','like','%'.request('search').'%');
            
            foreach($querytambahans as $querytambahan){
                $querybantuan= (string)$querytambahan->kodeMaterial;
                $barangkeluars->orWhere('kodeMaterial','like','%'.$querybantuan.'%');
            }
        }
        
        return view('stuffoutf/stuffout',[
            "title" => "Barang Keluar",
            "barangkeluars" => $barangkeluars->paginate(15),
            "kodematerials" => $kodematerials,
        ]);
    }

    public function printdelete(Request $request)
    {   
        $kodematerials = kodeMaterial::all();
        if($request->delete){
            barangKeluar::destroy($request->delete);
            return redirect('/stuffout')->with('success','Data Dihapus');
        }elseif($request->generate){
            $cek=false;
            $lastId = barangKeluar::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
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
                        // Melakukan pencarian berdasarkan nilai input dari request pada model barangKeluar
                        $foundMaterial = barangKeluar::find($request->$inputName);
    
                        if ($foundMaterial) {
                            $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                        }
                    }
                }
                $pdf = Pdf::loadView('stuffoutf.pdf', [
                    "kodematerials" => $kodematerials,
                    "barangkeluars" => $data
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Barang_Keluar.pdf');
            }else{
                $barangkeluars = barangKeluar::query();
                if($request->search){
                    $querytambahans=kodeMaterial::where('peruntukan','like','%'.request('search').'%')
                                        ->orWhere('namaMaterial','like','%'.request('search').'%')
                                        ->orWhere('satuan','like','%'.request('search').'%')->get();
                                        
                    $barangkeluars->where('kodeMaterial','like','%'.request('search').'%')
                                                ->orWhere('jumlah','like','%'.request('search').'%')
                                                ->orWhere('kondisi','like','%'.request('search').'%')
                                                ->orWhere('keterangan','like','%'.request('search').'%')
                                                ->orWhere('keperluan','like','%'.request('search').'%')
                                                ->orWhere('keterangan','like','%'.request('search').'%')
                                                ->orWhere('peminjam','like','%'.request('search').'%')
                                                ->orWhere('divisi','like','%'.request('search').'%')
                                                ->orWhere('tanggalKeluar','like','%'.request('search').'%');
                    
                    foreach($querytambahans as $querytambahan){
                        $querybantuan= (string)$querytambahan->kodeMaterial;
                        $barangkeluars->orWhere('kodeMaterial','like','%'.$querybantuan.'%');
                    }
                }
                $kodematerials = $kodematerials->toArray();
                $barangkeluars = $barangkeluars->get()->toArray();
                $pdf = Pdf::loadView('stuffoutf.pdf', [
                    "kodematerials" => $kodematerials,
                    "barangkeluars" => $barangkeluars
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Barang_Keluar.pdf');
            } 
        }
        
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
        $kodematerial=kodeMaterial::where('kodeMaterial', $request->kodeMaterial)->first();
        if ($kodematerial->stok - $request->jumlah >= 0) {
            $kodematerial->stok = $kodematerial->stok - $request->jumlah;
        }else{
            return redirect('/stuffout')->with('success','Stok Tidak Mencukupi');
        }

        if ($request->keperluan == 'PEMINJAMAN') {
            $kodematerial->frekuensi = $kodematerial->frekuensi + $request->jumlah;
        }else{
            $kodematerial->frekuensi = 0;
        }

        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'keperluan' => 'required',
            'keterangan' => 'required',
            'peminjam' => 'required',
            'divisi' => 'required',
            'tanggalKeluar' => 'required',
        ]);
        kodeMaterial::where('kodeMaterial', $request->kodeMaterial)
        ->update([
            'stok' => $kodematerial->stok,
            'frekuensi' => $kodematerial->frekuensi
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
        $kodematerial=kodeMaterial::where('kodeMaterial', $request->kodeMaterial)->first();
        if ($request->jumlah>$barangKeluar->jumlah) {
            $perubahan = $request->jumlah - $barangKeluar->jumlah;
        }elseif ($request->jumlah<$barangKeluar->jumlah) {
            $perubahan = $request->jumlah - $barangKeluar->jumlah;
        }else{
            $perubahan = 0;
        }
        if ($kodematerial->stok - $perubahan >= 0) {
            $kodematerial->stok = $kodematerial->stok - $perubahan;
        }else{
            return redirect('/stuffout')->with('success','Stok Tidak Mencukupi');
        }
        if ($barangKeluar->keperluan == 'RETUR') {
            if ($request->keperluan == 'PEMINJAMAN') {
                    $perubahan =  $request->jumlah;
            }else{
                $perubahan = 0;
            }
        }elseif($barangKeluar->keperluan == 'PEMINJAMAN'){
            if ($request->keperluan == 'RETUR') {
                $perubahan =  0-$request->jumlah;
            }else{
                if ($request->jumlah>$barangKeluar->jumlah) {
                    $perubahan = $request->jumlah - $barangKeluar->jumlah;
                }elseif ($request->jumlah<$barangKeluar->jumlah){
                    $perubahan = $request->jumlah - $barangKeluar->jumlah;
                }else{
                    $perubahan = 0;
                }
            }
        }
        $kodematerial->frekuensi = $kodematerial->frekuensi + $perubahan;
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'keperluan' => 'required',
            'keterangan' => 'required',
            'tanggalKeluar' => 'required',
        ]);
        kodeMaterial::where('kodeMaterial', $request->kodeMaterial)
        ->update([
            'stok' => $kodematerial->stok,
            'frekuensi' => $kodematerial->frekuensi
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
        $kodematerial=kodeMaterial::where('kodeMaterial', $barangKeluar->kodeMaterial)->first();
        $kodematerial->stok = $kodematerial->stok + $barangKeluar->jumlah;
        kodeMaterial::where('kodeMaterial', $barangKeluar->kodeMaterial)
                    ->update(['stok' => $kodematerial->stok]);
        barangKeluar::destroy($barangKeluar->id);
        return redirect('/stuffout')->with('success','Data Dihapus');
    }
}
