<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\KawasanRtlh;
use Illuminate\Database\Seeder;

class KawasanRtlhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KawasanRtlh::truncate();

        $csvFile = fopen(base_path("database/data-seeder/kawasan_rtlh.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                KawasanRtlh::create([
                    "kelurahan_id" => $data["1"],
                    "jumlah" => $data["3"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
