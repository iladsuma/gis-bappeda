<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenFsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_fs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_kegiatan_id');
            $table->foreignId('opd_id');
            $table->string('nama_kegiatan');
            $table->string('tahun');
            $table->string('dokumen_fs');
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
        Schema::dropIfExists('dokumen_fs');
    }
}
