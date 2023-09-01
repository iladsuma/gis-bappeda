<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Dokumen\DokumenFisik;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class DokumenFisikController extends Controller
{
    //

    public function index()
    {
        $lokasi = LokasiKegiatan::get();
        $opd = Opd::get();
        return view('backend.dokumenfisik.index', [
            'lokasi' => $lokasi,
            'opd' => $opd
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(DokumenFisik::with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $dokumen_fisik = DokumenFisik::where('id', $id)->with('lokasi:id,nama')->first();
        return response()->json([
            'data' => $dokumen_fisik
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);
        $dokumen_fisik = DokumenFisik::findOrFail($id);
        DB::beginTransaction();
        try {
            $dokumen_fisik->nama_kegiatan = $request->nama_kegiatan;
            $dokumen_fisik->opd_id = $request->opd_id;
            // $dokumen_fisik->lokasi_kegiatan_id = $request->lokasi_id;
            $dokumen_fisik->tahun = $request->tahun;
            $dokumen_fisik->lokasi()->sync($lokasi_kegiatan_ids);
            if ($request->hasFile('dokumen')) {
                File::delete(public_path('assets/dokumen_fisik/' . $dokumen_fisik->dokumen));
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_fisik'), $nama_dokumen);
                $dokumen_fisik->dokumen = $nama_dokumen;
            }
            if ($request->hasFile('foto')) {
                File::delete(public_path('assets/dokumen_fisik/foto' . $dokumen_fisik->dokumen));
                $nama_foto = $request->nama_kegiatan . "." . $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->move(public_path('assets/dokumen_fisik/foto'), $nama_foto);
                $dokumen_fisik->foto = $nama_foto;
            }
            $dokumen_fisik->save();
            $dokumen_fisik->lokasi()->sync($lokasi_kegiatan_ids);
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
            $dokumen_fisik = DokumenFisik::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun' => $request->tahun,
                'opd_id' => $request->opd_id,
                // 'lokasi_kegiatan_id' => $request->lokasi_id,
                'dokumen' => $request->nama_kegiatan . ".pdf",
                'foto' => $request->nama_kegiatan . "." . $request->file('foto')->getClientOriginalExtension(),
            ]);
            $dokumen_fisik->lokasi()->sync($lokasi_kegiatan_ids);

            if ($request->hasFile('dokumen')) {
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_fisik'), $nama_dokumen);
            }
            if ($request->hasFile('foto')) {
                $nama_dokumen = $request->nama_kegiatan . "." . $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->move(public_path('assets/dokumen_fisik/foto'), $nama_dokumen);
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
        $dokumen_fisik = DokumenFisik::find($id);
        if (file_exists(public_path('assets/dokumen_fisik/' . $dokumen_fisik->dokumen))) {
            File::delete(public_path('assets/dokumen_fisik/' . $dokumen_fisik->dokumen));
        }
        if (file_exists(public_path('assets/dokumen_fisik/foto' . $dokumen_fisik->foto))) {
            File::delete(public_path('assets/dokumen_fisik/foto' . $dokumen_fisik->foto));
        }
        $dokumen_fisik->delete();
    }
}
