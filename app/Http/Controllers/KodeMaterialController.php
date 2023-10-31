<?php

namespace App\Http\Controllers;

use App\Models\kodeMaterial;
use App\Http\Requests\StorekodeMaterialRequest;
use App\Http\Requests\UpdatekodeMaterialRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class KodeMaterialController extends Controller
{
    public function pdf(){
        
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
        kodeMaterial::destroy($kodeMaterial->id);
        return redirect('/code')->with('success','Data Dihapus');
    }
}
