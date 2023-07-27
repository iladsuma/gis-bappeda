<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataKelurahanController extends Controller
{
    public function index() 
    {
        return view('backend.datakelurahan.index');
    }
}
