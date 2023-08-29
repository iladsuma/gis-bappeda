<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Administrator\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('backend.admin-user.index', [
            'data_opd' => Opd::all(),
            'data_role' => Role::all(),
        ]);
    }

    public function datatable()
    {
        $datatable = DataTables::of(User::with(['opd', 'roles'])->orderBy('id', 'asc'))
        ->addIndexColumn()
        ->make('true');

        return $datatable;
    }

    public function store(Request $request)
    {
        $role = Role::where('id', $request->role_id)->first();

        DB::beginTransaction();

        try {
            $user = User::create([
                'opd_id' => $request->opd_id,
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'avatar' => 'avatar-default.png',
            ]);
            $user->assignRole($role);

            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            throw $error;
            return response($error->getMessage(), 500);
        }

        return response("Data berhasil ditambahkan");

    }
}
