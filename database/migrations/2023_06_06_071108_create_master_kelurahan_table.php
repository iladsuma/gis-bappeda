<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id');
            $table->string('nama_kelurahan');
            $table->string('kode_kelurahan');
            $table->string('geometry_file');
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
        Schema::dropIfExists('master_kelurahan');
    }
}
