<?php

namespace Database\Seeders\Dokumen;

use App\Models\Master\LokasiKegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        LokasiKegiatan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = fopen(base_path("database/data-seeder/master_lokasi.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                LokasiKegiatan::create([
                    "kelurahan_id" => $data["1"],
                    "nama" => $data["2"],
                    "alamat" => $data["3"],
                    "deskripsi" => $data["4"],
                    "coordinate" => $data["5"],
                    "foto" => $data["6"],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
