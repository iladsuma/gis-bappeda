<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Dokumen\DokumenLingkungan;
use App\Models\Master\LokasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class DokumenLingkunganController extends Controller
{
    //
    public function index()
    {
        $lokasi = LokasiKegiatan::get();
        $opd = Opd::get();
        return view('backend.dokumenlingkungan.index', [
            'lokasi' => $lokasi,
            'opd' => $opd
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(DokumenLingkungan::with(['lokasi', 'opd'])->orderBy('id', 'asc'))
            ->addIndexColumn()
            ->make('true');

        return $datatable;
    }

    public function edit($id)
    {
        $dokumen_lingkungan = DokumenLingkungan::where('id', $id)->with('lokasi:id,nama')->first();
        return response()->json([
            'data' => $dokumen_lingkungan
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $lokasi_kegiatan_ids = explode(",", $request->lokasi_id);
        $dokumen_lingkungan = DokumenLingkungan::findOrFail($id);

        DB::beginTransaction();
        try {
            $dokumen_lingkungan->nama_kegiatan = $request->nama_kegiatan;
            $dokumen_lingkungan->opd_id = $request->opd_id;
            // $dokumen_lingkungan->lokasi_kegiatan_id = $request->lokasi_id;
            $dokumen_lingkungan->tahun = $request->tahun;
            $dokumen_lingkungan->lokasi()->sync($lokasi_kegiatan_ids);
            if ($request->hasFile('dokumen')) {
                File::delete(public_path('assets/dokumen_lingkungan/' . $dokumen_lingkungan->dokumen));
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_lingkungan'), $nama_dokumen);
                $dokumen_lingkungan->dokumen = $request->nama_kegiatan . ".pdf";
            }
            $dokumen_lingkungan->save();
            $dokumen_lingkungan->lokasi()->sync($lokasi_kegiatan_ids);
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
            $dokumen_lingkungan = DokumenLingkungan::create([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun' => $request->tahun,
                'opd_id' => $request->opd_id,
                // 'lokasi_kegiatan_id' => $request->lokasi_id,
                'dokumen' => $request->nama_kegiatan . ".pdf",
            ]);
            $dokumen_lingkungan->lokasi()->sync($lokasi_kegiatan_ids);

            if ($request->hasFile('dokumen')) {
                $nama_dokumen = $request->nama_kegiatan . ".pdf";
                $request->file('dokumen')->move(public_path('assets/dokumen_lingkungan'), $nama_dokumen);
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
        $dokumen_lingkungan = DokumenLingkungan::find($id);
        if (file_exists(public_path('assets/dokumen_lingkungan/' . $dokumen_lingkungan->dokumen))) {
            File::delete(public_path('assets/dokumen_lingkungan/' . $dokumen_lingkungan->dokumen));
        }
        $dokumen_lingkungan->delete();
    }
}
