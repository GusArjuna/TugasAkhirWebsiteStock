<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Models\barangMasuk;
use App\Models\frekuensiBarang;
use App\Models\fsntable;
use App\Models\kodeMaterial;
use App\Models\persediaanAkhir;
use App\Models\persediaanAwal;
use App\Models\persediaanMasuk;
use App\Models\persediaanRata;
use App\Models\tor;
use App\Models\torParsial;
use App\Models\waktuPenyimpanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class displayer extends Controller
{
    public function fsnupdate(Request $request){
        // Perhitungan FSN
            // 1. Menentukan persediaan awal, yaitu persediaan bahan baku yang ada di setiap awal periode pengamatan.
            // 2. Menentukan persediaan akhir, yaitu persediaan barang yang tersisa di setiap akhir periode pengamatan. 
            //    Persediaan akhir periode yang diamati merupakan persediaan awal periode berikutnya. Jumlah 
            //    persediaan akhir dapat dihitung dengan rumus Akhir = Awal+Masuk-Keluar
            // 3. Menghitung nilai rata-rata persediaan, yaitu nilai rata-rata persediaan bahan baku yang ada setiap 
            //    periode pengamatan. Nilai rata-rata persediaan dapat dihitung dengan rumus Rata=(Awal+Akhir)/2
            // 4. Menghitung turn over ratio (TOR) parsial, yaitu rasio perputaran persediaan setiap periode berjalan. 
            //    Nilai TOR parsial dapat dihitung dengan rumus Torp=Keluar(frekuensi)/Rata
            // 5. Menghitung lamanya waktu penyimpanan, yaitu waktu rata-rata yang dialami oleh setiap bahan baku 
            //    untuk mengalami penyimpanan di gudang. Lamanya waktu penyimpanan barang dapat dihitung dengan rumus
            //    WaktuSimpan=JumlahHari dalam Sebulan/TorP
            // 6. Menghitung turn over ratio (TOR), yaitu rasio perputaran persediaan setiap selama satu tahun. 
            //    Nilai TOR dapat dihitung dengan rumus: TOR=JumlahHariSetahun/Waktu Simpan


        $year = $request->tahun; // Tahun yang diinginkan
        $loping = 1;
        $totalHariSetahun = 0;
        fsntable::truncate();

        for ($month = 1; $month <= 12; $month++) {
            $totalHariSetahun += cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }

        $allKodeMaterial = kodeMaterial::distinct('kodeMaterial')->pluck('kodeMaterial'); // manggil keseluruhan kode material
        foreach ($allKodeMaterial as $kodeMaterial) { //Foreach untuk FSN
            // Inisialisasi
            $persediaanAwal = []; // array untuk menampung data persediaan awal sekarang
            $hasil = []; // array untuk menampung data persediaan akhir
            $updateDataBarangMasuk = []; // array untuk menampung data persediaan masuk
            $updateDataBarangKeluar = []; // array untuk menampung data persediaan keluar
            $persediaanRata = []; // array untuk menampung data persediaan Rata Rata
            $TORParsial = []; // array untuk menampung data persediaan Rata Rata
            $waktuSimpan = []; // array untuk menampung data waktu Simpan
            $TOR = []; // array untuk menampung data waktu Simpan
            $kategori='';

            //Inisialisasi Tahun
            $stokPersediaanAwal =  persediaanAwal::where('kodeMaterial', $kodeMaterial)
                ->where('tahun', $year-1)
                ->first(); // array untuk mencar data persediaan Awalsebelumnya

            $updateDataBarangMasuk['Total']=0;
            $updateDataBarangKeluar['Total']=0;
            $persediaanRata['Total']=0;
            $TORParsial['Total']=0;
            $waktuSimpan['Total']=0;
            $TOR['Total']=0;         
            
            
            // Loop untuk menghitung jumlah barang masuk per bulan 
            for ($month = 1; $month <= 12; $month++) {
                // Pengambilan Data Barang Masuk untuk kode material saat ini
                $namaBulan = ucfirst(date("F", mktime(0, 0, 0, $month, 1)));
                $namaBulanSebelumnya = ucfirst(date("F", mktime(0, 0, 0, ($month-1==0)?1:$month-1, 1)));
                
                // Langkah 1 
                // mencari persediaan Awal,Akhir,Masuk,Keluar
                // untuk mencari dan menghitung jumlah barang yang masuk di setiap bulannya
                $updateDataBarangMasuk[$namaBulan] = (int) BarangMasuk::where('kodeMaterial', $kodeMaterial)
                ->whereYear('tanggalMasuk', $year) // Mencari hanya data barang masuk pada tahun yang sudah ku tentukan
                ->whereMonth('tanggalMasuk', $month) // Mencari hanya data barang masuk pada setiap bulan
                ->sum('jumlah');

                // untuk mencari dan menghitung jumlah barang yang keluar di setiap bulannya
                $updateDataBarangKeluar[$namaBulan] = (int) BarangKeluar::where('kodeMaterial', $kodeMaterial)
                ->whereYear('tanggalKeluar', $year) // Mencari hanya data barang masuk pada tahun yang sudah ku tentukan
                ->whereMonth('tanggalKeluar', $month) // Mencari hanya data barang masuk pada setiap bulan
                ->sum('jumlah');

                // perhitungan penambahan persediaan Akhir 
                if($month==1){
                    $hasil[$namaBulan]=$stokPersediaanAwal->January??0+$updateDataBarangMasuk[$namaBulan]-$updateDataBarangKeluar[$namaBulan];
                    $persediaanAwal[$namaBulan]=$hasil[$namaBulan];
                    $updateDataBarangMasuk['Total']+=$updateDataBarangMasuk[$namaBulan];
                    $updateDataBarangKeluar['Total']+=$updateDataBarangKeluar[$namaBulan];
                }else{
                    $hasil[$namaBulan]=$persediaanAwal[$namaBulanSebelumnya]+$updateDataBarangMasuk[$namaBulan]-$updateDataBarangKeluar[$namaBulan];
                    $persediaanAwal[$namaBulan]=$hasil[$namaBulan];
                    $updateDataBarangMasuk['Total']+=$updateDataBarangMasuk[$namaBulan];
                    $updateDataBarangKeluar['Total']+=$updateDataBarangKeluar[$namaBulan];
                }
                
                // Langkah 2 
                // Mencari Persediaan Rata Rata
                $stokPersediaanAwals=$stokPersediaanAwal->$namaBulan??0;
                $persediaanRata[$namaBulan]=($stokPersediaanAwals+$hasil[$namaBulan])/2;
                $persediaanRata['Total']+=$persediaanRata[$namaBulan];

                // Langkah 3
                // Mencari Tor Parsial
                if($persediaanRata[$namaBulan]>0){
                    $TORParsial[$namaBulan]=$updateDataBarangKeluar[$namaBulan]/$persediaanRata[$namaBulan];
                    $TORParsial['Total']+=$TORParsial[$namaBulan];

                    // Langkah 4
                    // Mencari Waktu Penyimpanan
                    if($TORParsial[$namaBulan]>0){
                        $waktuSimpan[$namaBulan]=cal_days_in_month(CAL_GREGORIAN, $month, $year)/$TORParsial[$namaBulan];
                        $waktuSimpan['Total']+=$waktuSimpan[$namaBulan];
                        
                        // Langkah 5
                        // Mencari TOR
                        if($waktuSimpan[$namaBulan]>0){
                            $TOR[$namaBulan]=$totalHariSetahun/$waktuSimpan[$namaBulan];
                            $TOR['Total']+=$TOR[$namaBulan];
                        }else{
                            $TOR[$namaBulan]=0;
                            $TOR['Total']+=$TOR[$namaBulan];
                        }
                        
                    }else{
                        $waktuSimpan[$namaBulan]=0;
                        $waktuSimpan['Total']+=$waktuSimpan[$namaBulan];
                        
                        // Langkah 5
                        // Mencari TOR
                        $TOR[$namaBulan]=0;
                        $TOR['Total']+=$TOR[$namaBulan];
                    }
                    
                }else{
                    $TORParsial[$namaBulan]=0;
                    $TORParsial['Total']+=$TORParsial[$namaBulan];

                    // Langkah 4
                    // Mencari Waktu Penyimpanan
                    $waktuSimpan[$namaBulan]=0;
                    $waktuSimpan['Total']+=$waktuSimpan[$namaBulan];
                    
                    // Langkah 5
                    // Mencari TOR
                    $TOR[$namaBulan]=0;
                    $TOR['Total']+=$TOR[$namaBulan];

                }

            }

            // Pengecekan Kategori TOR
            if($TOR['Total']>3){
                $kategori='Fast';
            }elseif($TOR['Total']>=1){
                $kategori='Slow';
            }else{
                $kategori='Non Moving';
            }
            
            // dd('stokPersediaanAwal ',$stokPersediaanAwal,
            // 'updateDataBarangMasuk',$updateDataBarangMasuk,
            // 'updateDataBarangKeluar',$updateDataBarangKeluar,
            // 'hasil = Awal+Masuk-Keluar',$hasil,
            // 'persediaanRata =(Awal+Akhir)/2',$persediaanRata,
            // 'TORParsial Keluar(frekuensi)/Rata',$TORParsial,
            // 'waktuSimpan =JumlahHari dalam Sebulan/TorP',$waktuSimpan,
            // 'TOR =JumlahHari Setahun/WSP',$TOR,
            // 'kategori',$kategori);
            

            // Lakukan update atau create ke persediaan Awal dengan data yang telah disiapkan
            if($stokPersediaanAwal==null){
                PersediaanAwal::create([
                    'Tahun' => $year-1,
                    'January' => 0,
                    'February' => 0,
                    'March' => 0,
                    'April' => 0,
                    'May' => 0,
                    'June' => 0,
                    'July' => 0,
                    'August' => 0,
                    'September' => 0,
                    'October' => 0,
                    'November' => 0,
                    'December' => 0,
                    'kodeMaterial' => $kodeMaterial
                ]);
                PersediaanAwal::create(array_merge($persediaanAwal, [
                    'Tahun' => $year,
                    'kodeMaterial' => $kodeMaterial
                ]));
            }else{
                PersediaanAwal::updateOrCreate(array_merge($persediaanAwal, [
                    'Tahun' => $year,
                    'kodeMaterial' => $kodeMaterial
                ]));
            }
            

            // Lakukan update atau create ke Persediaan Masuk dengan data yang telah disiapkan
            PersediaanMasuk::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $updateDataBarangMasuk
            );

               
            // Lakukan update atau create ke persediaan Keluar dengan data yang telah disiapkan
            frekuensiBarang::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $updateDataBarangKeluar
            );


            // Lakukan update atau create ke persediaan Akhir dengan data yang telah disiapkan
            persediaanAkhir::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $hasil
            );


            // Lakukan update atau create ke Persediaan Rata dengan data yang telah disiapkan
            persediaanRata::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $persediaanRata
            );

            // Lakukan update atau create ke Persediaan torParsial dengan data yang telah disiapkan
            torParsial::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $TORParsial
            );

            // Lakukan update atau create ke Persediaan waktuPenyimpanan dengan data yang telah disiapkan
            waktuPenyimpanan::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $waktuSimpan
            );

            // Lakukan update atau create ke Persediaan tor dengan data yang telah disiapkan
            tor::updateOrCreate(
                ['kodeMaterial' => $kodeMaterial],
                $TOR
            );

            fsntable::create([
                'kodeMaterial' => $kodeMaterial,
                'lokasi' => 'RAK ' . $loping,
                'tor' => $TOR['Total'],
                'kategori' =>  $kategori,
                'tahun' =>  $year,
            ]);

            $loping++;

        } // Akhir Foreach untuk menari persediaan Awal,Akhir,Keluar,Masuk
        
        $fsnss=fsntable::orderBy('tor', 'desc')->get();
        fsntable::truncate();
        $loping=1;
        foreach($fsnss as $fsnn){
            fsntable::create([
                'kodeMaterial' => $fsnn->kodeMaterial,
                'lokasi' => 'RAK ' . $loping,
                'tor' => $fsnn->tor,
                'kategori' =>  $fsnn->kategori,
                'tahun' =>  $fsnn->tahun,
            ]);

            $loping++;
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
        $kodematerials = kodeMaterial::all();
        $fsn = fsntable::query();
        if(request('search')){
            $querytambahans=kodeMaterial::where('peruntukan','like','%'.request('search').'%')
                                        ->orWhere('namaMaterial','like','%'.request('search').'%')
                                        ->orWhere('satuan','like','%'.request('search').'%')->get();
                                        
            $fsn->where('kodeMaterial','like','%'.request('search').'%')
                                        ->orWhere('tor','like','%'.request('search').'%')
                                        ->orWhere('kategori','like','%'.request('search').'%')
                                        ->orWhere('lokasi','like','%'.request('search').'%');
            
            foreach($querytambahans as $querytambahan){
                $querybantuan= (string)$querytambahan->kodeMaterial;
                $fsn->orWhere('kodeMaterial','like','%'.$querybantuan.'%');
            }
        }
        return view('home',[
            "title" => "Dashboard",
            "fsns" => $fsn->paginate(15),
            "kodematerials" => $kodematerials,
        ]);
    }

    public function stok()
    {
        $kodematerials = kodeMaterial::query();
        if(request('search')){
            $kodematerials->where('kodeMaterial','like','%'.request('search').'%')
                          ->orWhere('namaMaterial','like','%'.request('search').'%')
                          ->orWhere('stok','like','%'.request('search').'%')
                          ->orWhere('frekuensi','like','%'.request('search').'%')
                          ->orWhere('peruntukan','like','%'.request('search').'%')
                          ->orWhere('satuan','like','%'.request('search').'%');
        }
        return view('stock',[
            "title" => "Stock",
            "kodematerials" => $kodematerials->paginate(15),
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
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Stok.pdf');
            }else{
            $data = kodeMaterial::query();
            if($request->search){
                $data->where('kodeMaterial','like','%'.$request->search.'%')
                          ->orWhere('namaMaterial','like','%'.$request->search.'%')
                          ->orWhere('stok','like','%'.$request->search.'%')
                          ->orWhere('frekuensi','like','%'.$request->search.'%')
                          ->orWhere('peruntukan','like','%'.$request->search.'%')
                          ->orWhere('satuan','like','%'.$request->search.'%');
            }
            $data = $data->get()->toArray();
            $pdf = Pdf::loadView('pdfstok', ["kodematerials" => $data,])->setPaper('f4', 'landscape');
            return $pdf->download('Laporan_Stok.pdf');
            }   
        }        
    }

    public function printdashboard(Request $request)
    {   
        if($request->generate){
            $cek=false;
            $lastId = fsntable::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            $kodematerials = kodeMaterial::all();
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
                $pdf = Pdf::loadView('pdfdashboard', ["fsns" => $data,"kodematerials" => $kodematerials])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Rak.pdf');
            }else{
            $fsn = fsntable::query();
            if($request->search){
                $querytambahans=kodeMaterial::where('peruntukan','like','%'.$request->search.'%')
                                            ->orWhere('namaMaterial','like','%'.$request->search.'%')
                                            ->orWhere('satuan','like','%'.$request->search.'%')->get();
                                            
                $fsn->where('kodeMaterial','like','%'.$request->search.'%')
                                            ->orWhere('tor','like','%'.$request->search.'%')
                                            ->orWhere('kategori','like','%'.$request->search.'%')
                                            ->orWhere('lokasi','like','%'.$request->search.'%');
                
                foreach($querytambahans as $querytambahan){
                    $querybantuan= (string)$querytambahan->kodeMaterial;
                    $fsn->orWhere('kodeMaterial','like','%'.$querybantuan.'%');
                }
            }
            $kodematerials = $kodematerials->toArray();
            $fsn = $fsn->get()->toArray();
            $pdf = Pdf::loadView('pdfdashboard', ["fsns" => $fsn,"kodematerials" => $kodematerials])->setPaper('f4', 'landscape');
            return $pdf->download('Laporan_Rak_FSN.pdf');
            }   
        }
    }
}
