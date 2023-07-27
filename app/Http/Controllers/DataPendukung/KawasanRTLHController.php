<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KawasanRTLHController extends Controller
{
    public function index()
    {
        return view ("backend.kawasanrtlh.index");
    }
}
