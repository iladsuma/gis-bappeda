<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Dokumen\DokumenDed;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class DokumenDedController extends Controller
{
    //
    public function index()
    {
        $lokasi = LokasiKegiatan::get();
        $opd = Opd::get();
        return view('backend.dokumended.index', [
            'lokasi' => $lokasi,
            'opd' => $opd
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(DokumenDed::with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $dokumen_ded = DokumenDed::findOrFail($id);
        return response()->json([
            'data' => $dokumen_ded
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);
        $dokumen_ded = DokumenDed::findOrFail($id);
        $dokumen_ded->nama_kegiatan = $request->nama_kegiatan;
        $dokumen_ded->opd_id = $request->opd_id;
        // $dokumen_ded->lokasi_kegiatan_id = $request->lokasi_id;
        $dokumen_ded->tahun = $request->tahun;
        $dokumen_ded->lokasi()->sync($lokasi_kegiatan_ids);
        if ($request->hasFile('dokumen')) {
            File::delete(public_path('assets/dokumen_ded/' . $dokumen_ded->dokumen));
            $nama_dokumen = $request->nama_kegiatan . ".pdf";
            $request->file('dokumen')->move(public_path('assets/dokumen_ded'), $nama_dokumen);
            $dokumen_ded->dokumen = $request->nama_kegiatan . ".pdf";
        }
        $dokumen_ded->save();

        return response("Data berhasil diubah");
    }

    public function store(Request $request)
    {
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);
        DB::beginTransaction();
        try {
            $dokumen_ded = DokumenDed::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun' => $request->tahun,
                'opd_id' => $request->opd_id,
                // 'lokasi_kegiatan_id' => $request->lokasi_id,
                'dokumen' => $request->nama_kegiatan . ".pdf",
            ]);
            $dokumen_ded->lokasi()->sync($lokasi_kegiatan_ids);

            if ($request->hasFile('dokumen')) {
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_ded'), $nama_dokumen);
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
        $dokumen_ded = DokumenDed::find($id);
        if (file_exists(public_path('assets/dokumen_ded/' . $dokumen_ded->dokumen))) {
            File::delete(public_path('assets/dokumen_ded/' . $dokumen_ded->dokumen));
        }
        $dokumen_ded->delete();
    }
}
