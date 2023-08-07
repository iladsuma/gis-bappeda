<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationData;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DataOpdController extends Controller
{
    public function index()
    {
        return view('backend.dataopd.index');
    }

    public function datatable()
    {
        $datatable = DataTables::of(Opd::orderBy('id', 'asc'))
        ->addIndexColumn()
        ->make('true');

        return $datatable;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|unique:master_opd',
            'alamat' => 'required',
            "deskripsi" => 'required',
        ]);
        DB::beginTransaction();
        try {
            $opd = Opd::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
            ]);
            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            throw $error;
            return response($error->getMessage(),500) ;
        }
        return response("Data berhasil ditambahkan");
    }

    public function edit($id)
    {
        $opd = Opd::findOrFail($id);
        return response()->json([
            'data' => $opd
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $opd = Opd::findOrFail($id);
        $opd->nama = $request->nama;
        $opd->alamat = $request->alamat;
        $opd->deskripsi = $request->deskripsi;
        $opd->save();

        return response("Data berhaisl diubah");
    }

    public function drop($id)
    {
        $opd = Opd::find($id);
        $opd->delete();
    }
}
