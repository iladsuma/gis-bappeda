<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokasiSpamController extends Controller
{
    public function index()
    {
        return view("backend.lokasi-spam.index");
    }
}
