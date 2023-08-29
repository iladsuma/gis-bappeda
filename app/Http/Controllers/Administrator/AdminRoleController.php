<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AdminRoleController extends Controller
{
    //
    public function index()
    {
        return view('backend.admin-role.index');
    }

    public function datatable()
    {
        $datatables = DataTables::of(Role::query())
            ->addIndexColumn();
        return $datatables->make(true);
    }

    public function create()
    {
        $permissions = Permission::get();

        $permissionsFormatted = [];

        if ($permissions) {
            foreach ($permissions as $permission) {
                $_permission = explode(".", $permission->name);
                if (count($_permission) == 2) {
                    $permissionsFormatted[$_permission[0]][] = [
                        'name' => $_permission[1],
                        'value' => $permission->id
                    ];
                }
            }
        }

        $response = [
            'permissionsFormatted' => $permissionsFormatted
        ];
        return Response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $_permission = explode(",", $request->permission);
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $request->input('role_name')]);
            $role->syncPermissions($_permission);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 501);
        }

        return response('Hak akses ' . $role->name . ' berhasil dibuat');
    }
}
