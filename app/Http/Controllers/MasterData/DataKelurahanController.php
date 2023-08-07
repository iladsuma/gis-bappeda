<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKecamatan;
use App\Models\Master\MasterKelurahan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
        $kelurahan = MasterKelurahan::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        return response("Data berhasil ditambahkan");
    }
}
