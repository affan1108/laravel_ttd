<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sekolahs';
    protected $guarded = []; 

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }

    public function akses(){
        return $this->hasMany(Akses::class, 'id');
    }

    public function pemeriksaan(){
        return $this->hasMany(Pemeriksaan::class, 'id');
    }
}
