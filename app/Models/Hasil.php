<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

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
