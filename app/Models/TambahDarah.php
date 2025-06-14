<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahDarah extends Model
{
  use HasFactory;

  protected $table = 'tablet_tambah_darah';
  protected $guarded = ['id'];
  public function pemeriksaan()
  {
    return $this->belongsTo(Pemeriksaan::class, 'id_pemeriksaan');
  }
}
