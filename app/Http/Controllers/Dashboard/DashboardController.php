<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\DokumenDed;
use App\Models\Dokumen\DokumenFisik;
use App\Models\Dokumen\DokumenFs;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Dokumen\DokumenMp;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('backend.dashboard.index', [
            "jumlah_lokasi" => count(LokasiKegiatan::all()),
            "jumlah_dokumen_fs" => count(DokumenFs::all()),
            "jumlah_dokumen_mp" => count(DokumenMp::all()),
            "jumlah_dokumen_lingkungan" => count(DokumenLingkungan::all()),
            "jumlah_dokumen_ded" => count(DokumenDed::all()),
            "jumlah_dokumen_fisik" => count(DokumenFisik::all()),
        ]);
    }
}
