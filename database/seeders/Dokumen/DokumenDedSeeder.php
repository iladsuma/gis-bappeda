<?php

namespace Database\Seeders\Dokumen;

use App\Models\Dokumen\DokumenDed;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenDedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DokumenDed::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = fopen(base_path("database/data-seeder/dokumen_ded.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $lokasi_kegiatan_ids = explode(";", $data[1]);
                $dokumen_ded = DokumenDed::create([
                    // 'lokasi_kegiatan_id' => $data[1],
                    'opd_id' => $data[1],
                    'nama_kegiatan' => $data[2],
                    'tahun' => $data[3],
                    'dokumen' => $data[4],
                ]);
                $dokumen_ded->lokasi()->sync($lokasi_kegiatan_ids);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
