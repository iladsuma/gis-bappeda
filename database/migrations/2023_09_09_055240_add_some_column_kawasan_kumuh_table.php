<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnKawasanKumuhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kawasan_kumuh', function (Blueprint $table) {
            //add some column
            $table->string('tingkat_kumuh')->after('jumlah');
            $table->float('luas')->after('tingkat_kumuh');
            $table->year('tahun')->after('luas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kawasan_kumuh', function (Blueprint $table) {
            //drop some column
            $table->dropColumn('tingkat_kumuh');
            $table->dropColumn('luas');
            $table->dropColumn('tahun');
        });
    }
}
