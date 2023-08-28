<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiDokumenFsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_dokumen_fs', function (Blueprint $table) {
            $table->unsignedBigInteger('lokasi_kegiatan_id');
            $table->unsignedBigInteger('dokumen_fs_id');
            $table->foreign('lokasi_kegiatan_id')->references('id')->on('lokasi_kegiatan')->onDelete('cascade');
            $table->foreign('dokumen_fs_id')->references('id')->on('dokumen_fs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi_dokumen_fs');
    }
}
