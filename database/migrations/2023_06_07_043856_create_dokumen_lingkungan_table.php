<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenLingkunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_kegiatan_id')->nullable();
            $table->foreignId('opd_id');
            $table->string('nama_kegiatan');
            $table->string('tahun');
            $table->string('dokumen');
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
        Schema::dropIfExists('dokumen_lingkungan');
    }
}
