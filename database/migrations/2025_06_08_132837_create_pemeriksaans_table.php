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
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('nomer');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->foreignId('puskesmas_id')->constrained('puskesmas')->onUpdate('restrict')->onDelete('restrict');
            $table->string('nama_sekolah')->nullable();
            $table->string('alamat_sekolah')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jenis_kelamin');
            $table->string('nama_ortu');
            $table->softDeletes();
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
