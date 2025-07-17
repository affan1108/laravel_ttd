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

            // id_pemeriksaan sebaiknya foreign key bertipe unsignedBigInteger
            $table->unsignedBigInteger('id_pemeriksaan');

            // nik sebaiknya string dengan panjang dibatasi (misalnya 20)
            $table->string('nik', 20);

            // tgl_minum dan tgl_periksa_ulang sebaiknya bertipe DATE
            $table->date('tgl_minum');
            $table->date('tgl_periksa_ulang');

            // jumlah_tablet sebaiknya integer
            $table->integer('jumlah_tablet');

            // pengawas dan nomor_pengawas disarankan string
            $table->string('pengawas', 100);
            $table->string('nomor_pengawas', 20);

            // keterangan bisa nullable
            $table->text('keterangan')->nullable();
            
            $table->integer('aktif')->default(1); // kolom aktif untuk menandakan apakah data aktif atau tidak

            $table->timestamps();

            // foreign key constraint (optional tapi direkomendasikan)
            $table->foreign('id_pemeriksaan')->references('id')->on('pemeriksaans')->onDelete('cascade');
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
