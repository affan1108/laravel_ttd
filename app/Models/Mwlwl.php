<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MWLWL extends Model
{
    use HasFactory;

    // Tentukan kolom primary key
    protected $primaryKey = 'PATIENT_ID';

    // Nonaktifkan manajemen timestamps
    public $timestamps = false;

    protected $table = 'antrian_mwlwl';

    protected $fillable = [
        'PATIENT_ID',  // Tambahkan ini
        'PATIENT_NAME', 
        'ACCESSION_NO',
        'REQUEST_DEPARTMENT'
    ];
}
