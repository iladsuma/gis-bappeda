<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetColumnJumlahToNullableLokusStuntingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lokus_stunting', function (Blueprint $table) {
            //set to nullable
            $table->integer('jumlah')->nullable()->change();
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
            //rollback
            $table->integer('jumlah')->nullable(false);
        });
    }
}
