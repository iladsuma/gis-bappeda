<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\LokasiSumurPdam;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataLokasiSumurPdamController extends Controller
{
    //
    public function index()
    {
        $data_kelurahan = MasterKelurahan::select('id', 'nama')->get();

        return view('backend.lokasi-sumur-pdam.index', [
            'kelurahan'    => $data_kelurahan,
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(LokasiSumurPdam::with('kelurahan:id,kecamatan_id,nama', 'kelurahan.kecamatan:id,nama')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function store(Request $request)
    {
        $lat_lng = explode(",", $request->coordinate);
        $lat = $lat_lng[0];
        $lng = $lat_lng[1];
        DB::beginTransaction();
        try {
            $lokasi = LokasiSpam::create([
                'kelurahan_id' => $request->kelurahan_id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'lat' => $lat,
                'lng' => $lng,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response($th->getMessage(), 500);
        }

        return response("Data Lokasi berhasil ditambahkan");
    }

    public function edit($id)
    {
        $lokasi = LokasiSumurPdam::findOrFail($id);
        return response()->json([
            'data' => $lokasi
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiSumurPdam::findOrFail($id);
        $lat_lng = explode(",", $request->coordinate);
        $lat = $lat_lng[0];
        $lng = $lat_lng[1];
        DB::beginTransaction();
        try {
            $lokasi->kelurahan_id = $request->kelurahan_id;
            $lokasi->nama = $request->nama;
            $lokasi->alamat = $request->alamat;
            $lokasi->lat = $lat;
            $lokasi->lng = $lng;
            $lokasi->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response($th->getMessage(), 500);
        }

        return response("Data Lokasi berhasil diubah");
    }

    public function drop($id)
    {
        $data_lokasi = LokasiSpam::find($id);

        if (file_exists(public_path('assets/foto_spam/' . $data_lokasi->foto))) {
            File::delete(public_path('assets/foto_spam/' . $data_lokasi->foto));
        }
        $data_lokasi->delete();

        return response()->json([
            'title' => 'Berhasil',
            'message' => 'Lokasi Berhasil Dihapus',
            'icon' => 'success'
        ]);
    }
}
