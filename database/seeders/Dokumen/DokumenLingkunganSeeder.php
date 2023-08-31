<?php

namespace Database\Seeders\Dokumen;

use App\Models\Dokumen\DokumenLingkungan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenLingkunganSeeder extends Seeder
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
        DokumenLingkungan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csvFile = fopen(base_path("database/data-seeder/dokumen_lingkungan.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $lokasi_kegiatan_ids = explode(";", $data[1]);
                $dokumen_lingkungan = DokumenLingkungan::create([
                    // 'lokasi_kegiatan_id' => $data[1],
                    'opd_id' => $data[1],
                    'nama_kegiatan' => $data[2],
                    'tahun' => $data[3],
                    'dokumen' => $data[4],
                ]);
                $dokumen_lingkungan->lDokumenLingkungan()->sync($lokasi_kegiatan_ids);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
