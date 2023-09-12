<?php

namespace Database\Seeders\Pendukung;

use App\Models\Pendukung\LokasiSpam;
use Illuminate\Database\Seeder;

class LokasiSpamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        LokasiSpam::truncate();

        $csvFile = fopen(base_path("database/data-seeder/lokasi-spam.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LokasiSpam::create([
                    "nama" => $data["0"],
                    "alamat" => $data["1"],
                    "kelurahan_id" => $data["2"],
                    "tahun" => $data["3"],
                    "terpasang" => $data["4"],
                    "aktif" => $data["5"],
                    "lat" => $data["6"],
                    "lng" => $data["7"],
                    "image" => $data["8"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
