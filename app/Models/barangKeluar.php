<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangKeluar extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeMaterial',
        'jumlah',
        'kondisi',
        'peruntukan',
        'keperluan',
        'keterangan',
        'tanggalMasuk'
    ];
}
