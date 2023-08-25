<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\DokumenDed;
use App\Models\Dokumen\DokumenFs;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Dokumen\DokumenMp;
use App\Models\Master\LokasiKegiatan;
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
        return view('map.index', [
            'data_lokasi' => $data_lokasi,
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
        $datatable = DataTables::of(LokasiKegiatan::with(['dokumen_fs', 'dokumen_mp', 'dokumen_lingkungan', 'dokumen_ded'])->orderBy('id', 'asc'))
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
        $datatable_fs = DataTables::of(DokumenMp::where('lokasi_kegiatan_id', $id)->with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_fs;
    }

    public function datatable_lingkungan($id)
    {
        $datatable_fs = DataTables::of(DokumenLingkungan::where('lokasi_kegiatan_id', $id)->with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_fs;
    }

    public function datatable_ded($id)
    {
        $datatable_fs = DataTables::of(DokumenDed::where('lokasi_kegiatan_id', $id)->with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_fs;
    }

    public function kawasan_kumuh()
    {
        $kawasan_kumuh = KawasanKumuh::with('kelurahan')->get();

        $response = [
            'judul' => "Kawasan Kumuh",
            'data' => $kawasan_kumuh
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function kawasan_rtlh()
    {
        $kawasan_rtlh = KawasanRtlh::with('kelurahan')->get();

        $response = [
            'judul' => "RTLH",
            'data' => $kawasan_rtlh
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function lokus_kemiskinan()
    {
        $lokus_kemiskinan = LokusKemiskinan::with('kelurahan')->get();

        $response = [
            'judul' => "Lokus Kemiskinan",
            'data' => $lokus_kemiskinan
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function lokus_stunting()
    {
        $lokus_stunting = LokusStunting::with('kelurahan')->get();

        $response = [
            'judul' => "Lokus Stunting",
            'data' => $lokus_stunting
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
