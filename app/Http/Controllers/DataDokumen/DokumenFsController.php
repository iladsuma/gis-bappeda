<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Dokumen\DokumenFs;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class DokumenFsController extends Controller
{
    //
    public function index()
    {
        $opd = Opd::get();
        $lokasi = LokasiKegiatan::get();
        return view('backend.dokumenfs.index', [
            'lokasi' => $lokasi,
            'opd' => $opd
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(DokumenFs::with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $dokumen_fs = DokumenFs::where('id', $id)->with('lokasi:id,nama')->first();
        // dd($dokumen_fs);
        return response()->json([
            'data' => $dokumen_fs
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $dokumen_fs = DokumenFs::findOrFail($id);
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);

        DB::beginTransaction();

        try {
            $dokumen_fs->nama_kegiatan = $request->nama_kegiatan;
            $dokumen_fs->opd_id = $request->opd_id;
            $dokumen_fs->tahun = $request->tahun;
            $dokumen_fs->lokasi()->sync($lokasi_kegiatan_ids);
            if ($request->hasFile('dokumen')) {
                File::delete(public_path('assets/dokumen_fs/' . $dokumen_fs->dokumen));
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_fs'), $nama_dokumen);
                $dokumen_fs->dokumen = $request->nama_kegiatan . ".pdf";
            }
            $dokumen_fs->save();
            DB::commit();
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
            $dokumen_fs = DokumenFs::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun' => $request->tahun,
                'opd_id' => $request->opd_id,
                'dokumen' => $request->nama_kegiatan . ".pdf",
            ]);
            $dokumen_fs->lokasi()->sync($lokasi_kegiatan_ids);

            if ($request->hasFile('dokumen')) {
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_fs'), $nama_dokumen);
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
        $dokumen_fs = DokumenFs::find($id);
        if (file_exists(public_path('assets/dokumen_fs/' . $dokumen_fs->dokumen))) {
            File::delete(public_path('assets/dokumen_fs/' . $dokumen_fs->dokumen));
        }
        $dokumen_fs->delete();
    }
}
