<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DataDokumen\DokumenDedController;
use App\Http\Controllers\DataDokumen\DokumenFsController;
use App\Http\Controllers\DataDokumen\DokumenLingkunganController;
use App\Http\Controllers\DataDokumen\DokumenMpController;
use App\Http\Controllers\DataInfrastruktur\DataInfrastrukturController;
use App\Http\Controllers\DataPendukung\DataKawasanKumuhController;
use App\Http\Controllers\MasterData\DataKelurahanController;
use App\Http\Controllers\MasterData\DataLokasiController;
use App\Http\Controllers\DataPendukung\JaringanSpamPdamController;
use App\Http\Controllers\DataPendukung\KawasanRTLHController;
use App\Http\Controllers\DataPendukung\LokusKemiskinanController;
use App\Http\Controllers\DataPendukung\LokusStuntingController;
use App\Http\Controllers\Map\MapController;
use App\Http\Controllers\MasterData\DataOpdController;
use App\Models\Dokumen\DokumenFs;
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

    ## --- Start of Map Route --- ##
    Route::get('/', [MapController::class, 'index'])->name('map.index');
    Route::get('/lokasi/all', [MapController::class, 'lokasi'])->name('map.lokasi-all');
    Route::get('/lokasi/{id}/datatable-fs', [MapController::class, 'datatable_fs'])->name('map.datatable-fs');
    Route::get('/lokasi/{ids}/filter', [MapController::class, 'filter_select'])->name('map.filter-select');
    ## --- End of Map Route --- ##


    ## --- Start of Dashboard Route --- ##
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    ## --- Start of Dashboard Route --- ##

    ## --- Start of master data --- ##
    // Data OPD Route
    Route::get('/data-opd', [DataOpdController::class, 'index'])->name('data-opd.index');
    Route::get('/data-opd/datatable', [DataOpdController::class, 'datatable'])->name('data-opd.datatable');
    Route::post('/data-opd/store', [DataOpdController::class, 'store'])->name('data-opd.store');
    Route::get('/data-opd/{id}/edit', [DataOpdController::class, 'edit'])->name('data-opd.edit');
    Route::put('/data-opd/{id}/update', [DataOpdController::class, 'update'])->name('data-opd.update');
    Route::delete('/data-opd/{id}/drop', [DataOpdController::class, 'drop'])->name('data-opd.drop');
    // Data Kelurahan Route
    Route::get('/data-kelurahan', [DataKelurahanController::class, 'index'])->name('data-kelurahan.index');
    Route::get('/data-kelurahan/datatable', [DataKelurahanController::class, 'datatable'])->name('data-kelurahan.datatable');
    Route::post('/data-kelurahan/store', [DataKelurahanController::class, 'store'])->name('data-kelurahan.store');
    Route::get('/data-kelurahan/{id}/edit', [DataKelurahanController::class, 'edit'])->name('data-kelurahan.edit');
    Route::put('/data-kelurahan/{id}/update', [DataKelurahanController::class, 'update'])->name('data-kelurahan.update');
    Route::delete('/data-kelurahan/{id}/drop', [DataKelurahanController::class, 'drop'])->name('data-kelurahan.drop'); //  not yet work
    // Data lokasi Route
    Route::get('/data-lokasi', [DataLokasiController::class, 'index'])->name('data-lokasi.index');
    Route::get('/data-lokasi/datatable', [DataLokasiController::class, 'datatable'])->name('data-lokasi.datatable');
    Route::post('/data-lokasi/store', [DataLokasiController::class, 'store'])->name('data-lokasi.store');
    Route::get('/data-lokasi/{id}/edit', [DataLokasiController::class, 'edit'])->name('data-lokasi.edit');
    Route::put('/data-lokasi/{id}/update', [DataLokasiController::class, 'update'])->name('data-lokasi.update');
    Route::delete('/data-lokasi/{id}/drop', [DataLokasiController::class, 'drop'])->name('data-lokasi.drop'); // not yet work
    ## --- end of master data --- ##


    ## --- start of data dokumen --- ##
    // Dokumen feasibility route
    Route::get('/data-dokumen-fs', [DokumenFsController::class, 'index'])->name('data-dokumen-fs.index');
    Route::get('/data-dokumen-fs/datatable', [DokumenFsController::class, 'datatable'])->name('data-dokumen-fs.datatable');
    Route::post('/data-dokumen-fs/store', [DokumenFsController::class, 'store'])->name('data-dokumen-fs.store');
    Route::get('/data-dokumen-fs/{id}/edit', [DokumenFsController::class, 'edit'])->name('data-dokumen-fs.edit');
    Route::delete('/data-dokumen-fs/{id}/drop', [DokumenFsController::class, 'drop'])->name('data-dokumen-fs.drop');
    Route::put('/data-dokumen-fs/{id}/update', [DokumenFsController::class, 'update'])->name('data-dokumen-fs.update');

    // Dokumen masterplan route
    Route::get('/data-dokumen-masterplan', [DokumenMpController::class, 'index'])->name('data-dokumen-mp.index');
    Route::post('/data-dokumen-masterplan/store', [DokumenMpController::class, 'store'])->name('data-dokumen-mp.store');
    Route::get('/data-dokumen-masterplan/datatable', [DokumenMpController::class, 'datatable'])->name('data-dokumen-mp.datatable');
    Route::get('/data-dokumen-masterplan/{id}/edit', [DokumenMpController::class, 'edit'])->name('data-dokumen-mp.edit');
    Route::put('/data-dokumen-masterplan/{id}/update', [DokumenMpController::class, 'update'])->name('data-dokumen-mp.update');
    Route::delete('/data-dokumen-masterplan/{id}/drop', [DokumenMpController::class, 'drop'])->name('data-dokumen-mp.drop');

    // Dokumen lingkungan route
    Route::get('/data-dokumen-lingkungan', [DokumenLingkunganController::class, 'index'])->name('data-dokumen-lingkungan.index');
    Route::post('/data-dokumen-lingkungan/store', [DokumenLingkunganController::class, 'store'])->name('data-dokumen-lingkungan.store');
    Route::get('/data-dokumen-lingkungan/datatable', [DokumenLingkunganController::class, 'datatable'])->name('data-dokumen-lingkungan.datatable');
    Route::get('/data-dokumen-lingkungan/{id}/edit', [DokumenLingkunganController::class, 'edit'])->name('data-dokumen-lingkungan.edit');
    Route::put('/data-dokumen-lingkungan/{id}/update', [DokumenLingkunganController::class, 'update'])->name('data-dokumen-lingkungan.update');
    Route::delete('/data-dokumen-lingkungan/{id}/drop', [DokumenLingkunganController::class, 'drop'])->name('data-dokumen-lingkungan.drop');

    // dokumen ded route
    Route::get('/data-dokumen-ded', [DokumenDedController::class, 'index'])->name('data-dokumen-ded.index');
    Route::post('/data-dokumen-ded/store', [DokumenDedController::class, 'store'])->name('data-dokumen-ded.store');
    Route::get('/data-dokumen-ded/datatable', [DokumenDedController::class, 'datatable'])->name('data-dokumen-ded.datatable');
    Route::get('/data-dokumen-ded/{id}/edit', [DokumenDedController::class, 'edit'])->name('data-dokumen-ded.edit');
    Route::put('/data-dokumen-ded/{id}/update', [DokumenDedController::class, 'update'])->name('data-dokumen-ded.update');
    Route::delete('/data-dokumen-ded/{id}/drop', [DokumenDedController::class, 'drop'])->name('data-dokumen-ded.drop');

    ## --- end of data dokumen --- ##


    ## --- Start of Data Infrasturktur --- ##
    // Data Inftastruktur route
    Route::get('/data-infrastruktur', [DataInfrastrukturController::class, 'index'])->name('data-infrastruktur.index');
    Route::get('/data-infrastruktur/{id}/dokumen', [DataInfrastrukturController::class, 'get_dokumen'])->name('data-infrastruktur.dokumen');
    ## --- End of Data Infrasturktur --- ##


    ## --- Start of Data Pendukung --- ##
    // Data kawasan kumuh route
    Route::get('/data-kawasan-kumuh', [DataKawasanKumuhController::class, 'index'])->name('data-kawasan-kumuh.index');
    Route::get('/data-kawasan-kumuh/datatable', [DataKawasanKumuhController::class, 'datatable'])->name('data-kawasan-kumuh.datatable');
    Route::post('/data-kawasan-kumuh/store', [DataKawasanKumuhController::class, 'store'])->name('data-kawasan-kumuh.store');
    Route::get('/data-kawasan-kumuh/{id}/edit', [DataKawasanKumuhController::class, 'edit'])->name('data-kawasan-kumuh.edit');
    Route::put('/data-kawasan-kumuh/{id}/update', [DataKawasanKumuhController::class, 'update'])->name('data-kawasan-kumuh.update');
    Route::delete('/data-kawasan-kumuh/{id}/drop', [DataKawasanKumuhController::class, 'drop'])->name('data-kawasan-kumuh.drop');
    // Data jaringan spam route
    Route::get('/data-jaringan-spampdam', [JaringanSpamPdamController::class, 'index'])->name('data-jaringan-spampdam.index');
    // Data kawasan rtlh route
    Route::get('/data-kawasan-rtlh', [KawasanRTLHController::class, 'index'])->name('data-kawasan-rtlh.index');
    // Data lokus kemiskinan route
    Route::get('/data-lokus-kemiskinan', [LokusKemiskinanController::class, 'index'])->name('data-lokus-kemiskinan.index');
    // Data lokus stunting route
    Route::get('/data-lokus-stunting', [LokusStuntingController::class, 'index'])->name('data-lokus-stunting.index');
    ## --- end of data pendukung --- ##
});

require __DIR__ . '/auth.php';
