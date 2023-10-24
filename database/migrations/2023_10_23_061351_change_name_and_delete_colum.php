<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameAndDeleteColum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jaringan_spam_pdam', function (Blueprint $table) {
            $table->renameColumn('nama_jaringan', 'nama');
            $table->dropColumn('geometry');
        });

        Schema::rename('jaringan_spam_pdam', 'jaringan_pipa_pdam');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jaringan_pipa_pdam', function (Blueprint $table) {
            $table->renameColumn('nama', 'nama_jaringan');
            $table->string('geometry');
        });

        Schema::rename('jaringan_pipa_pdam', 'jaringan_spam_pdam');
    }
}
