<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnKawasanRtlhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kawasan_rtlh', function (Blueprint $table) {
            //add some column
            $table->integer('penanganan')->after('jumlah');
            $table->year('tahun')->after('penanganan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kawasan_rtlh', function (Blueprint $table) {
            //drop some column
            $table->dropColumn('penanganan');
            $table->dropColumn('tahun');
        });
    }
}
