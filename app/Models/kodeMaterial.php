<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kodeMaterial extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeMaterial',
        'namaMaterial',
        'satuan'
    ];
    
    public function barangmasuk(){
        return $this->hasMany(barangMasuk::class);
    }

    public function barangkeluar(){
        return $this->hasMany(barangKeluar::class);
    }
}
