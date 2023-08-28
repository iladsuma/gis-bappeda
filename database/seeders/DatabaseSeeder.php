<?php

namespace Database\Seeders;

use Database\Seeders\Administrator\UserSeeder;
use Database\Seeders\Master\MasterKecamatanSeeder;
use Database\Seeders\Master\MasterKelurahanSeeder;
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
        ]);
    }
}
