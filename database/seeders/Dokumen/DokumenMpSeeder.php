<?php

namespace Database\Seeders\Dokumen;

use App\Models\Dokumen\DokumenMp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenMpSeeder extends Seeder
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
        DokumenMp::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = fopen(base_path("database/data-seeder/dokumen_mp.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $lokasi_kegiatan_ids = explode(";", $data[1]);
                $dokumen_mp = DokumenMp::create([
                    // 'lokasi_kegiatan_id' => $data[1],
                    'opd_id' => $data[1],
                    'nama_kegiatan' => $data[2],
                    'tahun' => $data[3],
                    'dokumen' => $data[4],
                ]);
                $dokumen_mp->lokasi()->sync($lokasi_kegiatan_ids);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
