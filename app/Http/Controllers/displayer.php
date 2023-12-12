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


        // $year = $request->tahun; // Tahun yang diinginkan
        $year = 2023;
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
            if($year>2023){
                $stokPersediaanAwal =  persediaanAwal::where('kodeMaterial', $kodeMaterial)
                ->whereYear('Tahun', $year-1)
                ->first(); // array untuk mencar data persediaan Awalsebelumnya
            }else{
                $stokPersediaanAwal =  persediaanAwal::where('kodeMaterial', $kodeMaterial)
                ->first(); // array untuk mencar data persediaan Awalsebelumnya
            }

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
            PersediaanAwal::create(array_merge($persediaanAwal, [
                'Tahun' => $year,
                'kodeMaterial' => $kodeMaterial
            ]));

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
        $fsn = fsntable::paginate(15);
        return view('home',[
            "title" => "Dashboard",
            "fsns" => $fsn,
            "kodematerials" => $kodematerials,
        ]);
    }

    public function stok()
    {
        $kodematerials = kodeMaterial::paginate(15);
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
