<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;

class DokumenDedController extends Controller
{
    //
    public function index()
    {
        $lokasi = LokasiKegiatan::get();
        $opd = Opd::get();
        return view('backend.dokumended.index', [
            'lokasi_kegiatan' => $lokasi,
            'opd' => $opd
        ]);
    }
}
