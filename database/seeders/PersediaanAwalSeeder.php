<?php

namespace Database\Seeders;

use App\Models\persediaanAwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersediaanAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['1060029',2,4,6,5,3,7,8,9,4,6,4,2,2022],
            ['1060018',2,4,6,5,3,7,8,9,4,6,4,2,2022],
            ['1060035',2,4,6,5,3,7,8,9,4,6,4,2,2022],
            ['1060045',2,4,6,5,3,7,8,9,4,6,4,2,2022],
            ['1060058',2,4,6,5,3,7,8,9,4,6,4,2,2022],
            // Tambahkan baris data lain di sini jika diperlukan
        ];

        foreach ($data as $item) {
            persediaanAwal::create([
                'kodeMaterial' => $item[0],
                'January' => $item[1],
                'February' => $item[2],
                'March' => $item[3],
                'April' => $item[4],
                'May' => $item[5],
                'June' => $item[6],
                'July' => $item[7],
                'August' => $item[8],
                'September' => $item[9],
                'October' => $item[10],
                'November' => $item[11],
                'December' => $item[12],
                'Tahun' => $item[13],
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
    }
}
