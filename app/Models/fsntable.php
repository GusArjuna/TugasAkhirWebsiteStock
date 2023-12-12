<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fsntable extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeMaterial',
        'tor',
        'kategori',
        'lokasi'
    ];
}
