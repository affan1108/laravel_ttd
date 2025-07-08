<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemeriksaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemeriksaans';
    protected $guarded = [];

    public function puskesmas()
    {
        return $this->belongsTo(Puskesmas::class, 'puskesmas_id');
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'nama_sekolah', 'id');
    }
}
