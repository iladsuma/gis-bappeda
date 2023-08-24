<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Master\LokasiKegiatan;
use App\Models\Master\MasterKecamatan;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\KawasanKumuh;
use App\Models\Pendukung\KawasanRtlh;
use App\Models\Pendukung\LokusKemiskinan;
use App\Models\Pendukung\LokusStunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class DataKelurahanController extends Controller
{
    public function index()
    {
        $kecamatan = MasterKecamatan::get();
        return view('backend.datakelurahan.index', ['kecamatan' => $kecamatan]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(MasterKelurahan::with('kecamatan')->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $kelurahan = MasterKelurahan::create([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'kecamatan_id' => $request->kecamatan_id,
            ]);
            if ($request->hasFile("geometry")) {
                $geometry_name = "geometry_" . $request->nama . "_" . date("Y");
                $geometry_ext = $request->file('geometry')->getClientOriginalExtension();
                $request->file('geometry')->move(public_path('assets/geometry_kelurahan'), $geometry_name . "." . $geometry_ext);
                $kelurahan->geometry = $geometry_name . "." . $geometry_ext;
                $kelurahan->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response($th->getMessage(), 500);
        }

        return response("Data Kelurahan berhasil ditambahkan");
    }

    public function edit($id)
    {
        $kelurahan = MasterKelurahan::findOrFail($id);
        return response()->json([
            'data' => $kelurahan
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $kelurahan = MasterKelurahan::findOrFail($id);
        DB::beginTransaction();
        try {
            $kelurahan->nama = $request->nama;
            $kelurahan->kode = $request->kode;
            $kelurahan->kecamatan_id = $request->kecamatan_id;

            if ($request->hasFile('geometry')) {
                File::delete(public_path('assets/geometry_kelurahan/' . $kelurahan->geometry));
                $geometry_name = "geometry_" . $request->nama . "_" . date("Y");
                $geometry_ext = $request->file('geometry')->getClientOriginalExtension();
                $request->file('geometry')->move(public_path('assets/geometry_kelurahan'), $geometry_name . "." . $geometry_ext);
                $kelurahan->geometry = $geometry_name . "." . $geometry_ext;
                $kelurahan->save();
            }
            $kelurahan->save();
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
        $kelurahan = MasterKelurahan::find($id);
        $lokasi = LokasiKegiatan::where('kelurahan_id',$id)->get();
        $kawasan_kumuh = KawasanKumuh::where('kelurahan_id',$id)->get();
        $kawasan_rtlh = KawasanRtlh::where('kelurahan_id',$id)->get();
        $lokus_kemiskinan = LokusKemiskinan::where('kelurahan_id',$id)->get();
        $lokus_stunting = LokusStunting::where('kelurahan_id',$id)->get();
        if (count($lokasi) > 0 || count($kawasan_kumuh) > 0 || count($kawasan_rtlh) > 0 || count($lokus_kemiskinan) > 0 || count($lokus_stunting) > 0) {
            return response()->json([
                "message"=>"Data tidak dapat dihapus!",
                "title"=>"Gagal!",
                "icon"=>"warning",
                "status"=>"401"
            ]
            );
        }
        DB::beginTransaction();
        
        try {
            if (file_exists(public_path('assets/geometry_kelurahan/' . $kelurahan->geometry))) {
                File::delete(public_path('assets/geometry_kelurahan/' . $kelurahan->geometry));
                
            }
            
            $kelurahan->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response()->json([
                "message"=>"Data tidak dapat dihapus!",
                "title"=>"Gagal!",
                "icon"=>"warning",
                "status"=>"500"
            ]
            );
        }
        
        return response()->json([
            "message"=>"Data berhasil dihapus!",
            "title"=>"Berhasil!",
            "icon"=>"success",
            "status"=>"200"
        ]
        );
    }
}
