<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnLokusStuntingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lokus_stunting', function (Blueprint $table) {
            //add some column
            $table->year('tahun')->after('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lokus_stunting', function (Blueprint $table) {
            //drop some column
            $table->dropColumn('tahun');
        });
    }
}
