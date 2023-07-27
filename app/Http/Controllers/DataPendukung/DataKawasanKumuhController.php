<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataKawasanKumuhController extends Controller
{
    public function index()
    {
        return view('backend.datakawasankumuh.index');
    }
}
