<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use App\Models\Dokumen\DokumenFs;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MapController extends Controller
{
    //
    public function index()
    {
        return view('map.index');
    }

    public function filter_select($ids)
    {
        $id = explode(",", $ids);

        $lokasi = LokasiKegiatan::with('kelurahan', 'kelurahan.kecamatan')
            ->whereIn('id', $id)
            ->get();

        $response = [
            'jumlah' => count($lokasi),
            'data' => $lokasi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function lokasi()
    {
        $lokasi = LokasiKegiatan::with('kelurahan', 'kelurahan.kecamatan')
            ->get();

        $response = [
            'jumlah' => count($lokasi),
            'data' => $lokasi
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function datatable_fs($id)
    {
        $datatable_fs = DataTables::of(DokumenFs::where('lokasi_kegiatan_id', $id)->with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable_fs;
    }
}
