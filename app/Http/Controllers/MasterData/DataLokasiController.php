<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataLokasiController extends Controller
{
    public function index() 
    {
        return view('backend.datalokasi.index');
    }
}
