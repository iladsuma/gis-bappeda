<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnCoordinateTypeVarcharToLongtextTableLokasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lokasi_kegiatan', function (Blueprint $table) {
            //
            $table->longText('coordinate')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lokasi_kegiatan', function (Blueprint $table) {
            //
            $table->string('coordinate')->change();
        });
    }
}
