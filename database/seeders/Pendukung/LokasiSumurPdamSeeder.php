<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\LokasiSumurPdam;
use Illuminate\Database\Seeder;

class LokasiSumurPdamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LokasiSumurPdam::truncate();

        $csvFile = fopen(base_path("database/data-seeder/lokasi-sumur-pdam.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LokasiSumurPdam::create([
                    "nama" => $data["0"],
                    "alamat" => $data["1"],
                    "kelurahan_id" => $data["2"],
                    "lat" => $data["3"],
                    "lng" => $data["4"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
