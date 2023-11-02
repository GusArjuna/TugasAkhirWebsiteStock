<?php

namespace App\Http\Controllers;

use App\Models\kodeMaterial;
use App\Http\Requests\StorekodeMaterialRequest;
use App\Http\Requests\UpdatekodeMaterialRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KodeMaterialController extends Controller
{
    public function pdf(Request $request){
        $collection = kodeMaterial::all();
        $data = $collection->toArray();
        $pdf = Pdf::loadView('codestufff.pdf', ["data" => $data]);
        return $pdf->download('Kode_Material.pdf');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kodematerials = kodeMaterial::paginate(15);
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

    public function printdelete(Request $request)
    {   
        if($request->delete){
            kodeMaterial::destroy($request->delete);
            return redirect('/code')->with('success','Data Dihapus');
        }elseif($request->generate){
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
                $pdf = Pdf::loadView('codestufff.pdf', ["data" => $data]);
                return $pdf->download('Kode_Material.pdf');
            }else{
                $collection = kodeMaterial::all();
                $data = $collection->toArray();
                $pdf = Pdf::loadView('codestufff.pdf', ["data" => $data]);
                return $pdf->download('Kode_Material.pdf');
            }
        }
        
    }

    public function store(StorekodeMaterialRequest $request)
    {
        $validatedData = $request->validate([
            'kodeMaterial' => 'required',
            'namaMaterial' => 'required',
            'satuan' => 'required',
            'peruntukan' => 'required',
        ]);

        kodeMaterial::create($validatedData);
        return redirect('/code')->with('success','Data Ditambahkan');
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
        return view('codestufff/dataedit',[
            "title" => "Edit Data Kode Material",
            "kodeMaterial" => $kodeMaterial
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekodeMaterialRequest $request, kodeMaterial $kodeMaterial)
    {
        $rules = [
            'satuan' => 'required',
            'peruntukan' => 'required',
        ];

        if ($request->kodeMaterial != $kodeMaterial->kodeMaterial) {
            $rules['kodeMaterial'] = 'required';
        }
        if ($request->namaMaterial != $kodeMaterial->namaMaterial) {
            $rules['namaMaterial'] = 'required';
        }

        $validatedData= $request->validate($rules);
        kodeMaterial::where('id',$kodeMaterial->id)
                    ->update($validatedData);
        return redirect('/code')->with('success','Data Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kodeMaterial $kodeMaterial)
    {
        
    }
}
