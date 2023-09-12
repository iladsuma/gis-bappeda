<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiIpalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_ipal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelurahan_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('tahun');
            $table->string('kondisi');
            $table->string('jumlah');
            $table->string('keluarga');
            $table->string('lat');
            $table->string('lng');
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
        Schema::dropIfExists('lokasi_ipal');
    }
}
