<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiDokumenLingkunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_dokumen_lingkungan', function (Blueprint $table) {
            $table->unsignedBigInteger('lokasi_kegiatan_id');
            $table->unsignedBigInteger('dokumen_lingkungan_id');
            $table->foreign('lokasi_kegiatan_id')->references('id')->on('lokasi_kegiatan')->onDelete('cascade');
            $table->foreign('dokumen_lingkungan_id')->references('id')->on('dokumen_lingkungan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi_dokumen_lingkungan');
    }
}
