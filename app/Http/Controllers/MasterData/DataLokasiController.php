<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterKelurahan;
use Illuminate\Http\Request;

class DataLokasiController extends Controller
{
    public function index()
    {
        $kelurahan = MasterKelurahan::get();
        return view('backend.datalokasi.index', [
            'kelurahan' => $kelurahan
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
