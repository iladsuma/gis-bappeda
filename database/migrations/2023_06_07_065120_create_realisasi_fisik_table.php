<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasiFisikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_fisik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_kegiatan_id');
            $table->foreignId('opd_id');
            $table->foreignId('dokumen_fs_id');
            $table->foreignId('dokumen_mp_id');
            $table->foreignId('dokumen_lingkungan_id');
            $table->foreignId('dokumen_ded_id');
            $table->string('nama_realisasi');
            $table->string('penyedia_jasa');
            $table->string('tahun');
            $table->string('anggaran');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasi_fisik');
    }
}
