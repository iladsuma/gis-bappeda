<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\KawasanKumuh;
use Illuminate\Database\Seeder;

class KawasanKumuhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KawasanKumuh::truncate();

        $csvFile = fopen(base_path("database/data-seeder/kawasan_kumuh.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                KawasanKumuh::create([
                    "kelurahan_id" => $data["1"],
                    "jumlah" => $data["3"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
