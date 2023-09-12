<?php

use App\Http\Controllers\Administrator\AdminRoleController;
use App\Http\Controllers\Administrator\AdminUserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DataDokumen\DokumenDedController;
use App\Http\Controllers\DataDokumen\DokumenFisikController;
use App\Http\Controllers\DataDokumen\DokumenFsController;
use App\Http\Controllers\DataDokumen\DokumenLingkunganController;
use App\Http\Controllers\DataDokumen\DokumenMpController;
use App\Http\Controllers\DataInfrastruktur\DataInfrastrukturController;
use App\Http\Controllers\DataPendukung\DataKawasanKumuhController;
use App\Http\Controllers\MasterData\DataKelurahanController;
use App\Http\Controllers\MasterData\DataLokasiController;
use App\Http\Controllers\DataPendukung\LokasiSpamController;
use App\Http\Controllers\DataPendukung\KawasanRTLHController;
use App\Http\Controllers\DataPendukung\LokusKemiskinanController;
use App\Http\Controllers\DataPendukung\LokusStuntingController;
use App\Http\Controllers\Map\MapController;
use App\Http\Controllers\MasterData\DataOpdController;
use App\Http\Controllers\Profile\UserController;
use App\Models\Dokumen\DokumenFs;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Route
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
    Route::get('/map/{id}/lokasi-spesifik', [MapController::class, 'lokasi_spesifik'])->name('map.lokasi-spesifik');
    Route::get('/map/datatable-modal', [MapController::class, 'datatable_modal'])->name('map.datatable-modal');
    Route::get('/map/lokasi-all', [MapController::class, 'lokasi'])->name('map.lokasi-all');
    Route::get('/map/kawasan-kumuh', [MapController::class, 'kawasan_kumuh'])->name('map.kawasan-kumuh');
    Route::get('/map/kawasan-rtlh', [MapController::class, 'kawasan_rtlh'])->name('map.kawasan-rtlh');
    Route::get('/map/lokus-kemiskinan', [MapController::class, 'lokus_kemiskinan'])->name('map.lokus-kemiskinan');
    Route::get('/map/lokus-stunting', [MapController::class, 'lokus_stunting'])->name('map.lokus-stunting');
    Route::get('/map/{id}/datatable-fs', [MapController::class, 'datatable_fs'])->name('map.datatable-fs');
    Route::get('/map/{id}/datatable-mp', [MapController::class, 'datatable_mp'])->name('map.datatable-mp');
    Route::get('/map/{id}/datatable-lingkungan', [MapController::class, 'datatable_lingkungan'])->name('map.datatable-lingkungan');
    Route::get('/map/{id}/datatable-ded', [MapController::class, 'datatable_ded'])->name('map.datatable-ded');
    Route::get('/map/{id}/datatable-fisik', [MapController::class, 'datatable_fisik'])->name('map.datatable-fisik');
    Route::get('/map/{ids}/lokasi-filter', [MapController::class, 'lokasi_filter'])->name('map.lokasi-filter');
    Route::get('/map/{id}/get-kelurahan', [MapController::class, 'get_kelurahan'])->name('map.get-kelurahan');
    Route::get('/map/{kec}/{kel}/lokasi-administrasi', [MapController::class, 'lokasi_administrasi'])->name('map.lokasi-administrasi');
    ## --- End of Map Route --- ##


    ## --- Start of Dashboard Route --- ##
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->can('Dashboard.Dashboard');
    ## --- Start of Dashboard Route --- ##

    ## --- Start of master data --- ##
    // Data OPD Route
    Route::get('/data-opd', [DataOpdController::class, 'index'])->name('data-opd.index')->can('Master Data.Data Opd');
    Route::get('/data-opd/datatable', [DataOpdController::class, 'datatable'])->name('data-opd.datatable')->can('Master Data.Data Opd');
    Route::post('/data-opd/store', [DataOpdController::class, 'store'])->name('data-opd.store')->can('Master Data.Data Opd');
    Route::get('/data-opd/{id}/edit', [DataOpdController::class, 'edit'])->name('data-opd.edit')->can('Master Data.Data Opd');
    Route::put('/data-opd/{id}/update', [DataOpdController::class, 'update'])->name('data-opd.update')->can('Master Data.Data Opd');
    Route::delete('/data-opd/{id}/drop', [DataOpdController::class, 'drop'])->name('data-opd.drop')->can('Master Data.Data Opd');
    // Data Kelurahan Route
    Route::get('/data-kelurahan', [DataKelurahanController::class, 'index'])->name('data-kelurahan.index')->can('Master Data.Data Kelurahan');
    Route::get('/data-kelurahan/datatable', [DataKelurahanController::class, 'datatable'])->name('data-kelurahan.datatable')->can('Master Data.Data Kelurahan');
    Route::post('/data-kelurahan/store', [DataKelurahanController::class, 'store'])->name('data-kelurahan.store')->can('Master Data.Data Kelurahan');
    Route::get('/data-kelurahan/{id}/edit', [DataKelurahanController::class, 'edit'])->name('data-kelurahan.edit')->can('Master Data.Data Kelurahan');
    Route::put('/data-kelurahan/{id}/update', [DataKelurahanController::class, 'update'])->name('data-kelurahan.update')->can('Master Data.Data Kelurahan');
    Route::delete('/data-kelurahan/{id}/drop', [DataKelurahanController::class, 'drop'])->name('data-kelurahan.drop')->can('Master Data.Data Kelurahan');
    // Data lokasi Route
    Route::get('/data-lokasi', [DataLokasiController::class, 'index'])->name('data-lokasi.index')->can('Master Data.Data Lokasi');
    Route::get('/data-lokasi/datatable', [DataLokasiController::class, 'datatable'])->name('data-lokasi.datatable')->can('Master Data.Data Lokasi');
    Route::post('/data-lokasi/store', [DataLokasiController::class, 'store'])->name('data-lokasi.store')->can('Master Data.Data Lokasi');
    Route::get('/data-lokasi/{id}/edit', [DataLokasiController::class, 'edit'])->name('data-lokasi.edit')->can('Master Data.Data Lokasi');
    Route::put('/data-lokasi/{id}/update', [DataLokasiController::class, 'update'])->name('data-lokasi.update')->can('Master Data.Data Lokasi');
    Route::delete('/data-lokasi/{id}/drop', [DataLokasiController::class, 'drop'])->name('data-lokasi.drop')->can('Master Data.Data Lokasi');
    ## --- end of master data --- ##


    ## --- start of data dokumen --- ##
    // Dokumen feasibility route
    Route::get('/data-dokumen-fs', [DokumenFsController::class, 'index'])->name('data-dokumen-fs.index')->can('Data Dokumen.Feasibility Study');
    Route::get('/data-dokumen-fs/datatable', [DokumenFsController::class, 'datatable'])->name('data-dokumen-fs.datatable')->can('Data Dokumen.Feasibility Study');
    Route::post('/data-dokumen-fs/store', [DokumenFsController::class, 'store'])->name('data-dokumen-fs.store')->can('Data Dokumen.Feasibility Study');
    Route::get('/data-dokumen-fs/{id}/edit', [DokumenFsController::class, 'edit'])->name('data-dokumen-fs.edit')->can('Data Dokumen.Feasibility Study');
    Route::delete('/data-dokumen-fs/{id}/drop', [DokumenFsController::class, 'drop'])->name('data-dokumen-fs.drop')->can('Data Dokumen.Feasibility Study');
    Route::put('/data-dokumen-fs/{id}/update', [DokumenFsController::class, 'update'])->name('data-dokumen-fs.update')->can('Data Dokumen.Feasibility Study');

    // Dokumen masterplan route
    Route::get('/data-dokumen-masterplan', [DokumenMpController::class, 'index'])->name('data-dokumen-mp.index')->can('Data Dokumen.Master Plan');
    Route::post('/data-dokumen-masterplan/store', [DokumenMpController::class, 'store'])->name('data-dokumen-mp.store')->can('Data Dokumen.Master Plan');
    Route::get('/data-dokumen-masterplan/datatable', [DokumenMpController::class, 'datatable'])->name('data-dokumen-mp.datatable')->can('Data Dokumen.Master Plan');
    Route::get('/data-dokumen-masterplan/{id}/edit', [DokumenMpController::class, 'edit'])->name('data-dokumen-mp.edit')->can('Data Dokumen.Master Plan');
    Route::put('/data-dokumen-masterplan/{id}/update', [DokumenMpController::class, 'update'])->name('data-dokumen-mp.update')->can('Data Dokumen.Master Plan');
    Route::delete('/data-dokumen-masterplan/{id}/drop', [DokumenMpController::class, 'drop'])->name('data-dokumen-mp.drop')->can('Data Dokumen.Master Plan');

    // Dokumen lingkungan route
    Route::get('/data-dokumen-lingkungan', [DokumenLingkunganController::class, 'index'])->name('data-dokumen-lingkungan.index')->can('Data Dokumen.Lingkungan');
    Route::post('/data-dokumen-lingkungan/store', [DokumenLingkunganController::class, 'store'])->name('data-dokumen-lingkungan.store')->can('Data Dokumen.Lingkungan');
    Route::get('/data-dokumen-lingkungan/datatable', [DokumenLingkunganController::class, 'datatable'])->name('data-dokumen-lingkungan.datatable')->can('Data Dokumen.Lingkungan');
    Route::get('/data-dokumen-lingkungan/{id}/edit', [DokumenLingkunganController::class, 'edit'])->name('data-dokumen-lingkungan.edit')->can('Data Dokumen.Lingkungan');
    Route::put('/data-dokumen-lingkungan/{id}/update', [DokumenLingkunganController::class, 'update'])->name('data-dokumen-lingkungan.update')->can('Data Dokumen.Lingkungan');
    Route::delete('/data-dokumen-lingkungan/{id}/drop', [DokumenLingkunganController::class, 'drop'])->name('data-dokumen-lingkungan.drop')->can('Data Dokumen.Lingkungan');

    // dokumen ded route
    Route::get('/data-dokumen-ded', [DokumenDedController::class, 'index'])->name('data-dokumen-ded.index')->can('Data Dokumen.Detail Engineering Design');
    Route::post('/data-dokumen-ded/store', [DokumenDedController::class, 'store'])->name('data-dokumen-ded.store')->can('Data Dokumen.Detail Engineering Design');
    Route::get('/data-dokumen-ded/datatable', [DokumenDedController::class, 'datatable'])->name('data-dokumen-ded.datatable')->can('Data Dokumen.Detail Engineering Design');
    Route::get('/data-dokumen-ded/{id}/edit', [DokumenDedController::class, 'edit'])->name('data-dokumen-ded.edit')->can('Data Dokumen.Detail Engineering Design');
    Route::put('/data-dokumen-ded/{id}/update', [DokumenDedController::class, 'update'])->name('data-dokumen-ded.update')->can('Data Dokumen.Detail Engineering Design');
    Route::delete('/data-dokumen-ded/{id}/drop', [DokumenDedController::class, 'drop'])->name('data-dokumen-ded.drop')->can('Data Dokumen.Detail Engineering Design');

    // dokumen fisik route
    Route::get('/data-dokumen-fisik', [DokumenFisikController::class, 'index'])->name('data-dokumen-fisik.index')->can('Data Dokumen.Dokumen Fisik');
    Route::post('/data-dokumen-fisik/store', [DokumenFisikController::class, 'store'])->name('data-dokumen-fisik.store')->can('Data Dokumen.Dokumen Fisik');
    Route::get('/data-dokumen-fisik/datatable', [DokumenFisikController::class, 'datatable'])->name('data-dokumen-fisik.datatable')->can('Data Dokumen.Dokumen Fisik');
    Route::get('/data-dokumen-fisik/{id}/edit', [DokumenFisikController::class, 'edit'])->name('data-dokumen-fisik.edit')->can('Data Dokumen.Dokumen Fisik');
    Route::put('/data-dokumen-fisik/{id}/update', [DokumenFisikController::class, 'update'])->name('data-dokumen-fisik.update')->can('Data Dokumen.Dokumen Fisik');
    Route::delete('/data-dokumen-fisik/{id}/drop', [DokumenFisikController::class, 'drop'])->name('data-dokumen-fisik.drop')->can('Data Dokumen.Dokumen Fisik');
    ## --- end of data dokumen --- ##


    ## --- Start of Data Infrasturktur --- ##
    // Data Inftastruktur route
    Route::get('/data-infrastruktur', [DataInfrastrukturController::class, 'index'])->name('data-infrastruktur.index');
    Route::get('/data-infrastruktur/{id}/dokumen', [DataInfrastrukturController::class, 'get_dokumen'])->name('data-infrastruktur.dokumen');
    ## --- End of Data Infrasturktur --- ##


    ## --- Start of Data Pendukung --- ##
    // Data kawasan kumuh route
    Route::get('/data-kawasan-kumuh', [DataKawasanKumuhController::class, 'index'])->name('data-kawasan-kumuh.index')->can('Data Pendukung.Kawasan Kumuh');
    Route::get('/data-kawasan-kumuh/datatable', [DataKawasanKumuhController::class, 'datatable'])->name('data-kawasan-kumuh.datatable')->can('Data Pendukung.Kawasan Kumuh');
    Route::post('/data-kawasan-kumuh/store', [DataKawasanKumuhController::class, 'store'])->name('data-kawasan-kumuh.store')->can('Data Pendukung.Kawasan Kumuh');
    Route::get('/data-kawasan-kumuh/{id}/edit', [DataKawasanKumuhController::class, 'edit'])->name('data-kawasan-kumuh.edit')->can('Data Pendukung.Kawasan Kumuh');
    Route::put('/data-kawasan-kumuh/{id}/update', [DataKawasanKumuhController::class, 'update'])->name('data-kawasan-kumuh.update')->can('Data Pendukung.Kawasan Kumuh');
    Route::delete('/data-kawasan-kumuh/{id}/drop', [DataKawasanKumuhController::class, 'drop'])->name('data-kawasan-kumuh.drop')->can('Data Pendukung.Kawasan Kumuh');
    // Data lokasi spam route
    Route::get('/data-lokasi-spam', [LokasiSpamController::class, 'index'])->name('data-lokasi-spam.index')->can('Data Pendukung.Jaringan Spam');
    // Data kawasan rtlh route
    Route::get('/data-kawasan-rtlh', [KawasanRTLHController::class, 'index'])->name('data-kawasan-rtlh.index')->can('Data Pendukung.Kawasan RTLH');
    Route::get('/data-kawasan-rtlh/datatable', [KawasanRTLHController::class, 'datatable'])->name('data-kawasan-rtlh.datatable')->can('Data Pendukung.Kawasan RTLH');
    Route::post('/data-kawasan-rtlh/store', [KawasanRTLHController::class, 'store'])->name('data-kawasan-rtlh.store')->can('Data Pendukung.Kawasan RTLH');
    Route::get('/data-kawasan-rtlh/{id}/edit', [KawasanRTLHController::class, 'edit'])->name('data-kawasan-rtlh.edit')->can('Data Pendukung.Kawasan RTLH');
    Route::put('/data-kawasan-rtlh/{id}/update', [KawasanRTLHController::class, 'update'])->name('data-kawasan-rtlh.update')->can('Data Pendukung.Kawasan RTLH');
    Route::delete('/data-kawasan-rtlh/{id}/drop', [KawasanRTLHController::class, 'drop'])->name('data-kawasan-rtlh.drop')->can('Data Pendukung.Kawasan RTLH');
    // Data lokus kemiskinan route
    Route::get('/data-lokus-kemiskinan', [LokusKemiskinanController::class, 'index'])->name('data-lokus-kemiskinan.index')->can('Data Pendukung.Lokus Kemiskinan');
    Route::get('/data-lokus-kemiskinan/datatable', [LokusKemiskinanController::class, 'datatable'])->name('data-lokus-kemiskinan.datatable')->can('Data Pendukung.Lokus Kemiskinan');
    Route::post('/data-lokus-kemiskinan/store', [LokusKemiskinanController::class, 'store'])->name('data-lokus-kemiskinan.store')->can('Data Pendukung.Lokus Kemiskinan');
    Route::get('/data-lokus-kemiskinan/{id}/edit', [LokusKemiskinanController::class, 'edit'])->name('data-lokus-kemiskinan.edit')->can('Data Pendukung.Lokus Kemiskinan');
    Route::put('/data-lokus-kemiskinan/{id}/update', [LokusKemiskinanController::class, 'update'])->name('data-lokus-kemiskinan.update')->can('Data Pendukung.Lokus Kemiskinan');
    Route::delete('/data-lokus-kemiskinan/{id}/drop', [LokusKemiskinanController::class, 'drop'])->name('data-lokus-kemiskinan.drop')->can('Data Pendukung.Lokus Kemiskinan');

    // Data lokus stunting route
    Route::get('/data-lokus-stunting', [LokusStuntingController::class, 'index'])->name('data-lokus-stunting.index')->can('Data Pendukung.Lokus Stunting');
    Route::get('/data-lokus-stunting/datatable', [LokusStuntingController::class, 'datatable'])->name('data-lokus-stunting.datatable')->can('Data Pendukung.Lokus Stunting');
    Route::post('/data-lokus-stunting/store', [LokusStuntingController::class, 'store'])->name('data-lokus-stunting.store')->can('Data Pendukung.Lokus Stunting');
    Route::get('/data-lokus-stunting/{id}/edit', [LokusStuntingController::class, 'edit'])->name('data-lokus-stunting.edit')->can('Data Pendukung.Lokus Stunting');
    Route::put('/data-lokus-stunting/{id}/update', [LokusStuntingController::class, 'update'])->name('data-lokus-stunting.update')->can('Data Pendukung.Lokus Stunting');
    Route::delete('/data-lokus-stunting/{id}/drop', [LokusStuntingController::class, 'drop'])->name('data-lokus-stunting.drop')->can('Data Pendukung.Lokus Stunting');
    ## --- end of data pendukung --- ##

    // User
    Route::put('/user/{id}.update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');

    ## administrator role, permission and add user
    Route::get('/admin/role', [AdminRoleController::class, 'index'])->name('admin-role.index')->can('Administrator.Hak Akses');
    Route::get('/admin/role/datatable', [AdminRoleController::class, 'datatable'])->name('admin-role.datatable')->can('Administrator.Hak Akses');
    Route::get('/admin/role/create', [AdminRoleController::class, 'create'])->name('admin-role.create')->can('Administrator.Hak Akses');
    Route::post('/admin/role/store', [AdminRoleController::class, 'store'])->name('admin-role.store')->can('Administrator.Hak Akses');
    Route::get('/admin/role/{id}/edit', [AdminRoleController::class, 'edit'])->name('admin-role.edit')->can('Administrator.Hak Akses');
    Route::put('/admin/role/{id}/update', [AdminRoleController::class, 'update'])->name('admin-role.update')->can('Administrator.Hak Akses');
    Route::delete('/admin/role/{id}/drop', [AdminRoleController::class, 'destroy'])->name('admin-role.destroy')->can('Administrator.Hak Akses');

    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin-user.index')->can('Administrator.Data User');
    Route::get('/admin/user/datatable', [AdminUserController::class, 'datatable'])->name('admin-user.datatable')->can('Administrator.Data User');
    Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('admin-user.store')->can('Administrator.Data User');
    Route::delete('/admin/user/{id}/drop', [AdminUserController::class, 'drop'])->name('admin-user.drop')->can('Administrator.Data User');
    Route::get('/admin/user/{id}/edit', [AdminUserController::class, 'edit'])->name('admin-user.edit')->can('Administrator.Data User');
    Route::put('/admin/user/{id}/update', [AdminUserController::class, 'update'])->name('admin-user.update')->can('Administrator.Data User');
});

require __DIR__ . '/auth.php';
