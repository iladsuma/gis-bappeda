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
        $opd = Opd::create([
            'nama' => 'Bappeda',
            'alamat' => 'Jl. Merdeka No.105, Kepanjen Kidul, Kec. Kepanjenkidul, Kota Blitar',
            'deskripsi' => 'Badan Perencanaan dan Pembangunan Daerah',
        ]);
    }
}
