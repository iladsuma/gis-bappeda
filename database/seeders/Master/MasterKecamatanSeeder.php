<?php

namespace Database\Seeders\Master;

use App\Models\Master\MasterKecamatan;
use Illuminate\Database\Seeder;

class MasterKecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterKecamatan::truncate();
        MasterKecamatan::create([
            'nama'  => 'Kepanjenkidul',
            'kode'  => '35.72.01'
        ]);

        MasterKecamatan::create([
            'nama'  => 'Sukorejo',
            'kode'  => '35.72.02'
        ]);


        MasterKecamatan::create([
            'nama'  => 'Sananwetan',
            'kode'  => '35.72.03'
        ]);

    //     MasterKecamatan::create([
    //         'nama'  => 'Sananwetan',
    //         'kode'  => '35.72.03'
    //     ]);

    //     MasterKecamatan::create([
    //         'nama'  => 'Sukorejo',
    //         'kode'  => '35.72.02'
    //     ]);
    // }
    }
}
