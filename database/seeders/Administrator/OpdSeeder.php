<?php

namespace Database\Seeders\Administrator;

use App\Models\Administrator\Opd;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Opd::truncate();

        $csvFile = fopen(base_path("database/data-seeder/master_opd.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Opd::create([
                    "nama" => $data["1"],
                    "alamat" => $data["2"],
                    "deskripsi" => $data["3"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
