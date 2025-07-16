<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kecamatans';
    protected $guarded = [];
    
    public function pemeriksaan(){
        return $this->hasMany(Pemeriksaan::class, 'id');
    }

    public function puskesmas(){
        return $this->hasMany(Puskesmas::class, 'id');
    }

    public function sekolah(){
        return $this->hasMany(Sekolah::class, 'id');
    }
}
