<?php

use App\Http\Controllers\DataPendukung\JaringanSpamPdamController;
use App\Http\Controllers\DataPendukung\KawasanRTLHController;
use App\Http\Controllers\DataPendukung\LokusKemiskinanController;
use App\Http\Controllers\DataPendukung\LokusStuntingController;
use App\Http\Controllers\DataPendukung\RiwayatPemiliharaanController;
use App\Http\Controllers\MasterData\DataOpdController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Rou
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('map.index');
    });
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::get('/data-opd',[DataOpdController::class,'index'])->name('dataopd.index');
    Route::get('/data-jaringanspampdam',[JaringanSpamPdamController::class,'index'])->name('jaringanspampdam.index');
    Route::get('/data-kawasanrtlh',[KawasanRTLHController::class,'index'])->name('kawasanrtlh.index');
    Route::get('/data-lokuskemiskinan',[LokusKemiskinanController::class,'index'])->name('lokuskemiskinan.index');
    Route::get('/data-lokusstunting',[LokusStuntingController::class,'index'])->name('lokusstunting.index');
    Route::get('/data-riwayatpemiliharaan',[RiwayatPemiliharaanController::class,'index'])->name('riwayatpemilharaan.index');

});

require __DIR__ . '/auth.php';
