<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(kodeMaterial::class,);
    }
}
