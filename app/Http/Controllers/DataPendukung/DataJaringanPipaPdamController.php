<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataJaringanPipaPdamController extends Controller
{
    public function index()
    {
        return view('backend.jaringan-pipa-pdam.index');
    }
}
