<?php

namespace Database\Seeders;

use Database\Seeders\Administrator\OpdSeeder;
use Database\Seeders\Administrator\UserSeeder;
use Database\Seeders\Dokumen\LokasiKegiatanSeeder;
use Database\Seeders\Master\MasterKecamatanSeeder;
use Database\Seeders\Master\MasterKelurahanSeeder;
use Database\Seeders\Pendukung\KawasanKumuhSeeder;
use Database\Seeders\Pendukung\KawasanRtlhSeeder;
use Database\Seeders\Pendukung\LokasiSpamSeeder;
use Database\Seeders\Pendukung\LokasiSumurPdamSeeder;
use Database\Seeders\Pendukung\LokusKemiskinanSeeder;
use Database\Seeders\Pendukung\LokusStuntingSeeder;
use Database\Seeders\Permission\PermissionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            MasterKecamatanSeeder::class,
            MasterKelurahanSeeder::class,
            PermissionSeeder::class,
            OpdSeeder::class,
            LokasiKegiatanSeeder::class,
            KawasanKumuhSeeder::class,
            KawasanRtlhSeeder::class,
            LokusKemiskinanSeeder::class,
            LokusStuntingSeeder::class,
            LokasiSpamSeeder::class,
            LokasiSumurPdamSeeder::class,
        ]);
    }
}
