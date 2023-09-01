<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\LokusStunting;
use Illuminate\Database\Seeder;

class LokusStuntingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LokusStunting::truncate();

        $csvFile = fopen(base_path("database/data-seeder/lokus_stunting.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LokusStunting::create([
                    "kelurahan_id" => $data["1"],
                    "jumlah" => $data["3"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
