<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\LokusKemiskinan;
use Illuminate\Database\Seeder;

class LokusKemiskinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LokusKemiskinan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/lokus_kemiskinan.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LokusKemiskinan::create([
                    "kelurahan_id" => $data["1"],
                    "jumlah" => $data["3"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
