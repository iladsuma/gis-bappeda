<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\JaringanPipaPdam;
use Illuminate\Database\Seeder;

class JaringanPipaPdamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JaringanPipaPdam::truncate();
        $jaringan_pipa_pdam = JaringanPipaPdam::create([
            'nama' => 'jaringan_pdam.geojson'
        ]);
    }
}
