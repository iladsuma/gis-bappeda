<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\DokumenDed;
use App\Models\Dokumen\DokumenFisik;
use App\Models\Dokumen\DokumenFs;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Dokumen\DokumenMp;
use App\Models\Master\LokasiKegiatan;
use App\Models\Master\MasterKecamatan;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\KawasanKumuh;
use App\Models\Pendukung\KawasanRtlh;
use App\Models\Pendukung\LokusKemiskinan;
use App\Models\Pendukung\LokusStunting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MapController extends Controller
{
    //
    public function index()
    {
        $data_lokasi = LokasiKegiatan::select('id', 'nama')->get();
        $kecamatan = MasterKecamatan::select('id', 'nama')->get();
        return view('map.index', [
            'data_lokasi' => $data_lokasi,
            'kecamatan' => $kecamatan
        ]);
    }

    public function get_kelurahan($id)
    {
        $kelurahan = MasterKelurahan::select('id', 'nama')->where('kecamatan_id', $id)->get();

        return response()->json([
            'kelurahan' => $kelurahan
        ]);
    }

    public function lokasi_spesifik($id)
    {
        $data_lokasi = LokasiKegiatan::where('id', $id)
            ->with('kelurahan', 'kelurahan.kecamatan')
            ->get();

        $response = [
            'data' => $data_lokasi,
            'jumlah' => count($data_lokasi),
            'method' => 'spesifik',
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function datatable_modal()
    {
        $datatable = DataTables::of(LokasiKegiatan::with(['dokumen_fs', 'dokumen_mp', 'dokumen_lingkungan', 'dokumen_ded', 'dokumen_fisik'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');
        return $datatable;
    }

    public function lokasi_filter($ids)
    {
        $id = explode(",", $ids);

        $lokasi = LokasiKegiatan::with('kelurahan', 'kelurahan.kecamatan')
            ->whereIn('id', $id)
            ->get();

        $response = [
            'jumlah' => count($lokasi),
            'data' => $lokasi,
            'method' => 'multiple',
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function lokasi_administrasi($kecamatan, $kelurahan)
    {
        if ($kecamatan == 0) {
            $lokasi = LokasiKegiatan::with('kelurahan:id,nama,kecamatan_id', 'kelurahan.kecamatan:id,nama')
                ->get();
        }

        if ($kecamatan != 0 && $kelurahan == 0) {
            $lokasi = LokasiKegiatan::whereHas('kelurahan', function ($q) use ($kecamatan) {
                $q->where('kecamatan_id', $kecamatan);
            })->with('kelurahan:id,nama,kecamatan_id', 'kelurahan.kecamatan:id,nama')->get();
        }

        if ($kecamatan != 0 && $kelurahan != 0) {
            $lokasi = LokasiKegiatan::with('kelurahan:id,nama,kecamatan_id', 'kelurahan.kecamatan:id,nama')->where('kelurahan_id', $kelurahan)->get();
        }

        $response = [
            'jumlah' => count($lokasi),
            'data' => $lokasi,
            'method' => 'wilayah',
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function lokasi()
    {
        $lokasi = LokasiKegiatan::with('kelurahan', 'kelurahan.kecamatan')
            ->get();

        $response = [
            'jumlah' => count($lokasi),
            'data' => $lokasi,
            'method' => 'all',
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function datatable_fs($id)
    {
        $datatable_fs = DataTables::of(DokumenFs::whereHas('lokasi', function ($q) use ($id) {
            $q->where('lokasi_kegiatan_id', $id);
        })->with('opd')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_fs;
    }

    public function datatable_mp($id)
    {
        $datatable_mp = DataTables::of(DokumenMp::whereHas('lokasi', function ($q) use ($id) {
            $q->where('lokasi_kegiatan_id', $id);
        })->with('opd')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_mp;
    }

    public function datatable_lingkungan($id)
    {
        $datatable_lingkungan = DataTables::of(DokumenLingkungan::whereHas('lokasi', function ($q) use ($id) {
            $q->where('lokasi_kegiatan_id', $id);
        })->with('opd')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_lingkungan;
    }

    public function datatable_ded($id)
    {
        $datatable_ded = DataTables::of(DokumenDed::whereHas('lokasi', function ($q) use ($id) {
            $q->where('lokasi_kegiatan_id', $id);
        })->with('opd')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_ded;
    }

    public function datatable_fisik($id)
    {
        $datatable_fisik = DataTables::of(DokumenFisik::whereHas('lokasi', function ($q) use ($id) {
            $q->where('lokasi_kegiatan_id', $id);
        })->with('opd')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_fisik;
    }

    public function kawasan_kumuh()
    {
        $kawasan_kumuh = KawasanKumuh::with('kelurahan')->get();

        $response = [
            'judul' => "Kawasan Kumuh",
            'data' => $kawasan_kumuh,
            'max_value' => $kawasan_kumuh->max('jumlah')
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function kawasan_rtlh()
    {
        $kawasan_rtlh = KawasanRtlh::with('kelurahan')->get();

        $response = [
            'judul' => "RTLH",
            'data' => $kawasan_rtlh,
            'max_value' => $kawasan_rtlh->max('jumlah')
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function lokus_kemiskinan()
    {
        $lokus_kemiskinan = LokusKemiskinan::with('kelurahan')->get();

        $response = [
            'judul' => "Lokus Kemiskinan",
            'data' => $lokus_kemiskinan,
            'max_value' => $lokus_kemiskinan->max('jumlah')
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function lokus_stunting()
    {
        $lokus_stunting = LokusStunting::with('kelurahan')->get();

        $response = [
            'judul' => "Lokus Stunting",
            'data' => $lokus_stunting,
            'max_value' => $lokus_stunting->max('jumlah')
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
