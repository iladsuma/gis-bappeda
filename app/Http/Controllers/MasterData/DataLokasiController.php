<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Master\LokasiKegiatan;
use App\Models\Master\MasterKelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DataLokasiController extends Controller
{
    public function index()
    {
        $kelurahan = MasterKelurahan::get();
        return view('backend.datalokasi.index', [
            'kelurahan' => $kelurahan
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(LokasiKegiatan::with(['kelurahan', 'kelurahan.kecamatan'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $lokasi = LokasiKegiatan::create([
                'kelurahan_id' => $request->kelurahan_id,
                'nama' => $request->nama_lokasi,
                'alamat' => $request->alamat,
                'coordinate' => $request->coordinate,
            ]);
            if ($request->hasFile("foto")) {
                $foto_name = $request->nama_lokasi . "-" . date("Y");
                $foto_ext = $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->move(public_path('assets/foto_lokasi'), $foto_name . $foto_ext);
                $lokasi->foto = $foto_name . $foto_ext;
                $lokasi->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response($th->getMessage(), 500);
        }

        return response("Data Lokasi berhasil ditambahkan");
    }
}
