<?php

namespace App\Http\Controllers\DataDokumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataInfrastrukturController extends Controller
{
    public function index()
    {
        return view('backend.datainfrastruktur.index');
    }
}
