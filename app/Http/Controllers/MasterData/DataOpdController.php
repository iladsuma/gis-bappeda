<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataOpdController extends Controller
{
    public function index()
    {
        return view ("backend.dataopd.index");
    }
}
