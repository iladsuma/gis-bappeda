<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Dokumen\DokumenMp;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class DokumenMpController extends Controller
{
    //
    public function index()
    {
        $lokasi = LokasiKegiatan::get();
        $opd = Opd::get();
        return view('backend.dokumenmp.index', [
            'lokasi' => $lokasi,
            'opd' => $opd
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(DokumenMp::with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $dokumen_mp = DokumenMp::findOrFail($id);
        return response()->json([
            'data' => $dokumen_mp
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);
        $dokumen_mp = DokumenMp::findOrFail($id);

        DB::beginTransaction();
        try {
            $dokumen_mp->nama_kegiatan = $request->nama_kegiatan;
            $dokumen_mp->opd_id = $request->opd_id;
            // $dokumen_mp->lokasi_kegiatan_id = $request->lokasi_id;
            $dokumen_mp->tahun = $request->tahun;
            $dokumen_mp->lokasi()->sync($lokasi_kegiatan_ids);
            if ($request->hasFile('dokumen')) {
                File::delete(public_path('assets/dokumen_mp/' . $dokumen_mp->dokumen));
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_mp'), $nama_dokumen);
                $dokumen_mp->dokumen = $request->nama_kegiatan . ".pdf";
            }
            $dokumen_mp->save();
        } catch (\Throwable $error) {
            DB::rollBack();
            throw $error;
            return response($error->getMessage(), 500);
        }


        return response("Data berhasil diubah");
    }

    public function store(Request $request)
    {
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);

        DB::beginTransaction();
        try {
            $dokumen_mp = DokumenMp::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun' => $request->tahun,
                'opd_id' => $request->opd_id,
                // 'lokasi_kegiatan_id' => $request->lokasi_id,
                'dokumen' => $request->nama_kegiatan . ".pdf",
            ]);
            $dokumen_mp->lokasi()->sync($lokasi_kegiatan_ids);

            if ($request->hasFile('dokumen')) {
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_mp'), $nama_dokumen);
            }
            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            throw $error;
            return response($error->getMessage(), 500);
        }
        return response("Data berhasil ditambahkan");
    }

    public function drop($id)
    {
        $dokumen_mp = DokumenMp::find($id);
        if (file_exists(public_path('assets/dokumen_mp/' . $dokumen_mp->dokumen))) {
            File::delete(public_path('assets/dokumen_mp/' . $dokumen_mp->dokumen));
        }
        $dokumen_mp->delete();
    }
}
