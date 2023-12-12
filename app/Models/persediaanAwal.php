<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persediaanAwal extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeMaterial',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
        'Tahun',
    ];
}
