<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\KawasanRtlh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KawasanRTLHController extends Controller
{
    public function index()
    {
        $data_kelurahan = MasterKelurahan::select('id', 'nama')->get();

        return view('backend.kawasanrtlh.index', [
            'data_kelurahan'    => $data_kelurahan,
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(KawasanRtlh::with('kelurahan', 'kelurahan.kecamatan')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $kawasan_rtlh = KawasanRtlh::findOrFail($id);
        return response()->json([
            'data' => $kawasan_rtlh
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $kawasan_rtlh = KawasanRtlh::findOrFail($id);

        DB::beginTransaction();
        try {
            $kawasan_rtlh->kelurahan_id = $request->kelurahan_id;
            $kawasan_rtlh->jumlah = $request->jumlah;
            $kawasan_rtlh->save();
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
            $kawasan_rtlh = KawasanRtlh::create([
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
        $kawasan_rtlh = KawasanRtlh::find($id);

        DB::beginTransaction();
        try {
            $kawasan_rtlh->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response("Data gagal dihapus");
        }

        return response("Data berhasil dihapus");
    }
}
