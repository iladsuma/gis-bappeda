<?php

namespace App\Http\Controllers\DataPendukung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokusKemiskinanController extends Controller
{
    public function index()
    {
        return view ("backend.lokuskemiskinan.index");
    }
}
