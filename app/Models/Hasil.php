<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hasil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hasils';
    protected $guarded = []; 

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_biodata');
    }

    public function puskesmas()
    {
        return $this->belongsTo(Puskesmas::class, 'id_puskesmas');
    }
}
