<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\LokusKemiskinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LokusKemiskinanController extends Controller
{
    public function index()
    {
        $data_kelurahan = MasterKelurahan::select('id', 'nama')->get();
        return view("backend.lokuskemiskinan.index", ['data_kelurahan' => $data_kelurahan]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(LokusKemiskinan::with('kelurahan', 'kelurahan.kecamatan')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $lokus_kemiskinan = LokusKemiskinan::findOrFail($id);
        return response()->json([
            'data' => $lokus_kemiskinan
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokus_kemiskinan = LokusKemiskinan::findOrFail($id);

        DB::beginTransaction();
        try {
            $lokus_kemiskinan->kelurahan_id = $request->kelurahan_id;
            $lokus_kemiskinan->jumlah = $request->jumlah;
            $lokus_kemiskinan->save();
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
            $lokus_kemiskinan = LokusKemiskinan::create([
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
        $lokus_kemiskinan = LokusKemiskinan::find($id);

        DB::beginTransaction();
        try {
            $lokus_kemiskinan->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response("Data gagal dihapus");
        }

        return response("Data berhasil dihapus");
    }
}
