<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangMasuk extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeMaterial',
        'jumlah',
        'kondisi',
        'peruntukan',
        'keterangan',
        'tanggalMasuk'
    ];
}
