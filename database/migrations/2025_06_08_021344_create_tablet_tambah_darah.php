<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tablet_tambah_darah', function (Blueprint $table) {
             $table->id();
            $table->string('id_pemeriksaan');
            $table->string('nik');
            $table->string('tgl_minum');
            $table->string('jumlah_tablet');
            $table->string('pengawas');
            $table->string('nomor_pengawas');
            $table->string('tgl_periksa_ulang');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablet_tambah_darah');
    }
};
