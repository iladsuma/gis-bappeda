<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\KawasanKumuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class DataKawasanKumuhController extends Controller
{
    public function index()
    {
        $data_kelurahan = MasterKelurahan::select('id', 'nama')->get();
        return view('backend.datakawasankumuh.index', [
            'data_kelurahan'    => $data_kelurahan,
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
        $kawasan_kumuh = KawasanKumuh::findOrFail($id);
        return response()->json([
            'data' => $kawasan_kumuh
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $kawasan_kumuh = KawasanKumuh::findOrFail($id);

        DB::beginTransaction();
        try {
            $kawasan_kumuh->kelurahan_id = $request->kelurahan_id;
            $kawasan_kumuh->jumlah = $request->jumlah;
            $kawasan_kumuh->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response("Data gagal diubah");
        }

        return response("Data berhasil diubah");
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $kawasan_kumuh = KawasanKumuh::create([
                'kelurahan_id'  => $request->kelurahan_id,
                'jumlah'        => $request->jumlah,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response("Data gagal ditambahkan");
        }


        return response("Data berhasil ditambahkan");
    }

    public function drop($id)
    {
        $kawasan_kumuh = KawasanKumuh::find($id);
        DB::beginTransaction();
        try {
            $kawasan_kumuh->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response("Data gagal dihapus");
        }
        return response("Data berhasil dihapus");
    }
}
