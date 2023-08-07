<?php

use App\Http\Controllers\DataDokumen\DataInfrastrukturController;
use App\Http\Controllers\DataPendukung\DataKawasanKumuhController;
use App\Http\Controllers\MasterData\DataKelurahanController;
use App\Http\Controllers\MasterData\DataLokasiController;
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

    // OPD
    Route::get('/data-opd', [DataOpdController::class, 'index'])->name('data-opd.index');
    Route::get('/data-opd/datatable', [DataOpdController::class, 'datatable'])->name('data-opd.datatable');
    Route::post('/data-opd/store', [DataOpdController::class, 'store'])->name('data-opd.store');
    Route::get('/data-opd/{id}/edit', [DataOpdController::class, 'edit'])->name('data-opd.edit');
    Route::put('/data-opd/{id}/update', [DataOpdController::class, 'update'])->name('data-opd.update');
    Route::delete('/data-opd/{id}/drop', [DataOpdController::class, 'drop'])->name('data-opd.drop');

    // Kelurahan
    Route::get('/data-kelurahan', [DataKelurahanController::class, 'index'])->name('data-kelurahan.index');
    Route::get('/data-kelurahan/datatable', [DataKelurahanController::class, 'datatable'])->name('data-kelurahan.datatable');
    Route::post('/data-kelurahan/store', [DataKelurahanController::class, 'store'])->name('data-kelurahan.store');
    Route::get('/data-kelurahan/{id}/edit', [DataKelurahanController::class, 'edit'])->name('data-kelurahan.edit');
    Route::put('/data-kelurahan/{id}/update', [DataKelurahanController::class, 'update'])->name('data-kelurahan.update');
    Route::delete('/data-kelurahan/{id}/drop', [DataKelurahanController::class, 'drop'])->name('data-kelurahan.drop');



    Route::get('/data-lokasi', [DataLokasiController::class, 'index'])->name('data-lokasi.index');
    Route::get('/data-infrastruktur', [DataInfrastrukturController::class, 'index'])->name('data-infrastruktur.index');
    Route::get('/data-kawasan-kumuh', [DataKawasanKumuhController::class, 'index'])->name('data-kawasan-kumuh.index');
    Route::get('/data-jaringanspampdam',[JaringanSpamPdamController::class,'index'])->name('jaringanspampdam.index');
    Route::get('/data-kawasanrtlh',[KawasanRTLHController::class,'index'])->name('kawasanrtlh.index');
    Route::get('/data-lokuskemiskinan',[LokusKemiskinanController::class,'index'])->name('lokuskemiskinan.index');
    Route::get('/data-lokusstunting',[LokusStuntingController::class,'index'])->name('lokusstunting.index');
    Route::get('/data-riwayatpemiliharaan',[RiwayatPemiliharaanController::class,'index'])->name('riwayatpemilharaan.index');

});

require __DIR__ . '/auth.php';
