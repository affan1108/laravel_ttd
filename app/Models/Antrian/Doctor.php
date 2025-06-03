<?php

namespace App\Models\Antrian;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    // Tentukan kolom primary key
    protected $primaryKey = 'id';

    protected $table = 'ms_user_123';

    // Nonaktifkan manajemen timestamps
    public $timestamps = false;

    protected $fillable = [
        'nama',  // Tambahkan ini
        'gelar_belakang', 
        'unit_ruang',
    ];
}
