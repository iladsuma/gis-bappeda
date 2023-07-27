<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JaringanSpamPdamController extends Controller
{
    public function index()
    {
        return view ("backend.jaringanspampdam.index");
    }//
}
