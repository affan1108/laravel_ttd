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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('nomer');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->string('puskesmas');
            $table->string('nama_sekolah');
            $table->string('alamat_sekolah');
            $table->string('kelas');
            $table->string('jenis_kelamin');
            $table->string('nama_ortu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
