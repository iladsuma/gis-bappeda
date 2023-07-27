<?php

use App\Http\Controllers\DataDokumen\DataInfrastrukturController;
use App\Http\Controllers\DataPendukung\DataKawasanKumuhController;
use App\Http\Controllers\MasterData\DataKelurahanController;
use App\Http\Controllers\MasterData\DataLokasiController;
use App\Http\Controllers\MasterData\DataOpdController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
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

    Route::get('/data-opd', [DataOpdController::class, 'index'])->name('data-opd.index');

    Route::get('/data-kelurahan', [DataKelurahanController::class, 'index'])->name('data-kelurahan.index');
    
    Route::get('/data-lokasi', [DataLokasiController::class, 'index'])->name('data-lokasi.index');
    
    Route::get('/data-infrastruktur', [DataInfrastrukturController::class, 'index'])->name('data-infrastruktur.index');

    Route::get('/data-kawasan-kumuh', [DataKawasanKumuhController::class, 'index'])->name('data-kawasan-kumuh.index');
});

require __DIR__ . '/auth.php';
