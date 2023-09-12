<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use App\Models\Pendukung\LokasiSpam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataLokasiSpamController extends Controller
{
    //
    public function index()
    {
        $data_kelurahan = MasterKelurahan::select('id', 'nama')->get();

        return view('backend.lokasi-spam.index', [
            'kelurahan'    => $data_kelurahan,
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(LokasiSpam::with('kelurahan:id,kecamatan_id,nama', 'kelurahan.kecamatan:id,nama')->orderBy('id', 'asc'))
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
                'tahun' => $request->tahun,
                'terpasang' => $request->terpasang,
                'aktif' => $request->aktif,
            ]);
            if ($request->hasFile("foto")) {
                $foto_name = $request->nama . "-" . date("Y");
                $foto_ext = $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->move(public_path('assets/foto_spam'), $foto_name . "." . $foto_ext);
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
        $lokasi = LokasiSpam::findOrFail($id);
        return response()->json([
            'data' => $lokasi
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiSpam::findOrFail($id);
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
            $lokasi->tahun = $request->tahun;
            $lokasi->terpasang = $request->terpasang;
            $lokasi->aktif = $request->aktif;
            if ($request->hasFile('foto')) {
                File::delete(public_path('assets/foto_spam/' . $lokasi->foto));
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
