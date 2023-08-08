<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;

class DokumenFsController extends Controller
{
    //
    public function index()
    {
        $opd = Opd::get();
        $lokasi = LokasiKegiatan::get();
        return view('backend.dokumenfs.index', [
            'lokasi_kegiatan' => $lokasi,
            'opd' => $opd
        ]);
    }
}
