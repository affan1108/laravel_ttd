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
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_biodata')->constrained('pemeriksaans')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('id_puskesmas')->nullable()->constrained('puskesmas')->onUpdate('restrict')->onDelete('restrict');
            $table->string("tgl_pemeriksaan");
            $table->string("hasil");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasils');
    }
};
