<?php

namespace App\Http\Controllers\DataInfrastruktur;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\DokumenDed;
use App\Models\Dokumen\DokumenFs;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Dokumen\DokumenMp;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;

class DataInfrastrukturController extends Controller
{
    //
    public function index()
    {
        $lokasi = LokasiKegiatan::get();
        return view('backend.datainfrastruktur.index', ['lokasi' => $lokasi]);
    }

    public function get_dokumen($lokasi_id)
    {
        $dokumen_fs = DokumenFs::where('lokasi_kegiatan_id', $lokasi_id)->get();
        $dokumen_mp = DokumenMp::where('lokasi_kegiatan_id', $lokasi_id)->get();
        $dokumen_lingkungan = DokumenLingkungan::where('lokasi_kegiatan_id', $lokasi_id)->get();
        $dokumen_ded = DokumenDed::where('lokasi_kegiatan_id', $lokasi_id)->get();

        $response = [
            'dokumenFs' => $dokumen_fs,
            'dokumenMp' => $dokumen_mp,
            'dokumenLingkungan' => $dokumen_lingkungan,
            'dokumenDed' => $dokumen_ded,
        ];

        return response()->json([
            'response' => $response,
            'status' => 200
        ]);
    }
}
