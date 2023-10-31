<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function kodematerial(): BelongsTo
    {
        return $this->belongsTo(kodeMaterial::class,);
    }
}
