<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\KawasanKumuh;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class DataKawasanKumuhController extends Controller
{
    public function index()
    {
        $dataKelurahan = MasterKelurahan::all();
        return view('backend.datakawasankumuh.index', [
            'data_kelurahan'    => $dataKelurahan,
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(KawasanKumuh::with('kelurahan', 'kelurahan.kecamatan')->orderBy('id', 'asc'))
        ->addIndexColumn()
        ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $kawasanKumuh = KawasanKumuh::findOrFail($id);
        return response()->json([
            'data' => $kawasanKumuh
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $kawasanKumuh = KawasanKumuh::findOrFail($id);
        $kawasanKumuh->kelurahan_id = $request->kelurahan_id;
        $kawasanKumuh->jumlah = $request->jumlah;
        $kawasanKumuh->save();

        return response("Data berhaisl diubah");
    }

    public function store(Request $request)
    {
        $kawasankumuh = KawasanKumuh::create([
            'kelurahan_id'  => $request->kelurahan_id,
            'jumlah'        => $request->jumlah,
        ]);

        return response("Data berhasil ditambahkan");
    }

    public function drop($id)
    {
        $opd = KawasanKumuh::find($id);
        $opd->delete();
    }
}
