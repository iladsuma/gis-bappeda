<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Master\LokasiKegiatan;
use App\Models\Master\MasterKelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

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
                $request->file('foto')->move(public_path('assets/foto_lokasi'), $foto_name . "." . $foto_ext);
                $lokasi->foto = $foto_name . "." . $foto_ext;
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

    public function edit($id)
    {
        $lokasi = LokasiKegiatan::findOrFail($id);
        return response()->json([
            'data' => $lokasi
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiKegiatan::findOrFail($id);
        // dd($request);
        DB::beginTransaction();
        try {
            $lokasi->kelurahan_id = $request->kelurahan_id;
            $lokasi->nama = $request->nama_lokasi;
            $lokasi->alamat = $request->alamat;
            $lokasi->coordinate = $request->coordinate;
            if ($request->hasFile('foto')) {
                File::delete(public_path('assets/foto_lokasi/' . $lokasi->foto));
                $foto_name = $request->nama_lokasi . "-" . date("Y");
                $foto_ext = $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->move(public_path('assets/foto_lokasi'), $foto_name . "." . $foto_ext);
                $lokasi->foto = $foto_name . "." . $foto_ext;
            }
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
        $data_lokasi = LokasiKegiatan::find($id);

        $val_fs = DB::table('lokasi_dokumen_fs')->where('lokasi_kegiatan_id', $id)->first();
        $val_mp = DB::table('lokasi_dokumen_mp')->where('lokasi_kegiatan_id', $id)->first();
        $val_ling = DB::table('lokasi_dokumen_lingkungan')->where('lokasi_kegiatan_id', $id)->first();
        $val_ded = DB::table('lokasi_dokumen_ded')->where('lokasi_kegiatan_id', $id)->first();
        if ($val_fs || $val_mp || $val_ded ||$val_ling) {
            return response()->json([
                'title' => 'Gagal',
                'message' => 'Lokasi Sedang Digunakan',
                'icon' => 'error'
            ]);
        }

        if (file_exists(public_path('assets/foto_lokasi/' . $data_lokasi->foto))) {
            File::delete(public_path('assets/foto_lokasi/' . $data_lokasi->foto));
        }
        $data_lokasi->delete();

        return response()->json([
            'title' => 'Berhasil',
            'message' => 'Lokasi Berhasil Dihapus',
            'icon' => 'success'
        ]);
    }
}
