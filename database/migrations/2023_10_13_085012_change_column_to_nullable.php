<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kawasan_kumuh', function (Blueprint $table) {
            $table->string('tingkat_kumuh')->nullable()->change();
            $table->float('luas')->nullable()->change();
        });

        Schema::table('kawasan_rtlh', function (Blueprint $table) {
            $table->integer('penanganan')->nullable()->change();
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
            $table->string('tingkat_kumuh')->nullable(false)->change();
            $table->float('luas')->nullable(false)->change();
        });

        Schema::table('kawasan_rtlh', function (Blueprint $table) {
            $table->integer('penanganan')->nullable(false)->change();
        });
    }
}
