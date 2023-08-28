<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
}
