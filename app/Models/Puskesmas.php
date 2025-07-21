<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puskesmas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'puskesmas';
    protected $guarded = []; 

    public function pemeriksaan(){
        return $this->hasMany(Pemeriksaan::class, 'id');
    }

    public function askes(){
        return $this->hasMany(Akses::class, 'id');
    }

    public function sekolah(){
        return $this->hasMany(Sekolah::class, 'id');
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
