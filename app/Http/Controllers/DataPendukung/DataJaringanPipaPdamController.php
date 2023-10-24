<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use App\Models\Pendukung\JaringanPipaPdam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DataJaringanPipaPdamController extends Controller
{
    public function index()
    {
        $jaringan_pipa_pdam = JaringanPipaPdam::find(1);
        return view('backend.jaringan-pipa-pdam.index', [
            'jaringan_pipa_pdam' => $jaringan_pipa_pdam->nama,
        ]);
    }

    public function loadGeoJson()
    {
        $geojson = JaringanPipaPdam::find(1);
        return response()->json($geojson->nama);
    }

    public function update(Request $request, $id)
    {
        $jaringan_pipa_pdam = JaringanPipaPdam::findOrFail(1);

        DB::beginTransaction();

        try {
            $jaringan_pipa_pdam->nama = 'jaringan_pdam.geojson';
            if ($request->hasFile('file-jaringan-pipa-pdam')) {
                // $request->validate([
                //     'file-jaringan-pipa-pdam' => 'mimes:pdf'
                // ]);
                File::delete(public_path('assets/jaringan_pdam/jaringan_pdam.geojson'));
                $nama = "jaringan_pdam.geojson";
                $request->file('file-jaringan-pipa-pdam')->move(public_path('assets/jaringan_pdam'), $nama);
                $jaringan_pipa_pdam->nama = "jaringan_pdam.geojson";
            }
            $jaringan_pipa_pdam->save();
            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            throw $error;
            return response($error->getMessage(), 500);
        }

        return response("Data berhasil diubah");;
    }
}
