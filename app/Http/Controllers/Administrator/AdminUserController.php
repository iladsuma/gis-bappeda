<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator\Opd;
use App\Models\Administrator\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

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

    public function edit($id)
    {
        $user = User::where('id', $id)->with('opd:id', 'roles:id')->first();
        return response()->json([
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->role_id);

        DB::beginTransaction();

        try {
            $user->name = $request->name;
            $user->username = $request->username;
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            $user->roles()->detach();
            $user->assignRole($role);
            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            throw $error;
            return response($error->getMessage(), 500);
        }

        return response("Data berhasil diubah");
    }


    public function drop($id)
    {
        $user = User::find($id);
        if ($user->avatar != "avatar-default.png") {
            File::delete(public_path('assets/image/avatar/' . $user->avatar));
        }
        $user->delete();
    }
}
