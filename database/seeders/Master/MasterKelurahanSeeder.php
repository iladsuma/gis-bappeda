<?php

namespace Database\Seeders\Master;

use App\Models\Master\MasterKelurahan;
use Illuminate\Database\Seeder;

class MasterKelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MasterKelurahan::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_kelurahan.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                MasterKelurahan::create([
                    "kecamatan_id" => $data["1"],
                    "nama" => $data["2"],
                    "kode" => $data["3"],
                    "geometry" => $data["4"],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
