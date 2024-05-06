<?php

use App\Http\Controllers\Api\ApiLoginControllers;
use App\Http\Controllers\Api\KelompokTani\DaftarAnggotaBaruApiControllers;
use App\Http\Controllers\Api\KelompokTani\DataPanenAnggotaApiControllers;
use App\Http\Controllers\Api\KelompokTani\TanggalPanenKelompokApiControllers;
use App\Http\Controllers\Api\Mandor\DataSpbMandorApiControllers;
use App\Http\Controllers\Api\Mandor\TanggalPanenMandorApiControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [ApiLoginControllers::class, 'login']);
Route::post('/logout', [ApiLoginControllers::class, 'logout']);

Route::middleware('auth:admin')->group(function () {
    Route::middleware('check.admin:1')->group(function () {
    });
    Route::middleware('check.admin:2')->group(function () {
    });
});

/**
 * API KELOMPOK TANI
 */
Route::get('/tanggal-panen-kelompok', [TanggalPanenKelompokApiControllers::class, 'index']);
Route::get('/tanggal-panen-kelompok/{id_superadmin}', [TanggalPanenKelompokApiControllers::class, 'getKelompok']);
Route::post('/tanggal-panen-kelompok/createData', [TanggalPanenKelompokApiControllers::class, 'createData']);
Route::get('/tanggal-panen-kelompok/update/{id_tanggal_panen}', [TanggalPanenKelompokApiControllers::class, 'update']);
Route::put('/tanggal-panen-kelompok/updateData/{id_tanggal_panen}', [TanggalPanenKelompokApiControllers::class, 'updateData']);
Route::delete('/tanggal-panen-kelompok/delete/{id_tanggal_panen}', [TanggalPanenKelompokApiControllers::class, 'delete']);

Route::get('/data-panen-anggota/{id_tanggal_panen}', [DataPanenAnggotaApiControllers::class, 'index']);
Route::get('/data-panen-anggota/create/{id_tanggal_panen}', [DataPanenAnggotaApiControllers::class, 'create']);
Route::post('/data-panen-anggota/createData/{id_tanggal_panen}', [DataPanenAnggotaApiControllers::class, 'createData']);
Route::get('/data-panen-anggota/update/{id_tanggal_panen}/{id_anggota_tervalidasi}', [DataPanenAnggotaApiControllers::class, 'update']);
Route::put('/data-panen-anggota/updateData/{id_tanggal_panen}/{id_anggota_tervalidasi}', [DataPanenAnggotaApiControllers::class, 'updateData']);
Route::delete('/data-panen-anggota/delete/{id_tanggal_panen}/{id_anggota_tervalidasi}', [DataPanenAnggotaApiControllers::class, 'delete']);


Route::get('/daftar-anggota-baru/{id_superadmin}', [DaftarAnggotaBaruApiControllers::class, 'index']);
Route::get('/get-kelompok/{id_superadmin}', [DaftarAnggotaBaruApiControllers::class, 'getKelompok']);
Route::get('/get-anggota-lama/{id_kelompok}', [DaftarAnggotaBaruApiControllers::class, 'getAnggotaLama']);
Route::post('/daftar-anggota-baru/createData/{id_superadmin}', [DaftarAnggotaBaruApiControllers::class, 'createData']);
Route::get('/daftar-anggota-baru/update/{id_daftar_anggota_baru}', [DaftarAnggotaBaruApiControllers::class, 'update']);
Route::put('/daftar-anggota-baru/updateData/{id_daftar_anggota_baru}/{id_superadmin}', [DaftarAnggotaBaruApiControllers::class, 'updateData']);
Route::delete('/daftar-anggota-baru/delete/{id_daftar_anggota_baru}', [DaftarAnggotaBaruApiControllers::class, 'delete']);
// Route::get('/data-panen-anggota/create/{id_tanggal_panen}', [DataPanenAnggotaApiControllers::class, 'create']);
// Route::post('/data-panen-anggota/createData/{id_tanggal_panen}', [DataPanenAnggotaApiControllers::class, 'createData']);
// Route::get('/data-panen-anggota/update/{id_tanggal_panen}/{id_anggota_tervalidasi}', [DataPanenAnggotaApiControllers::class, 'update']);
// Route::put('/data-panen-anggota/updateData/{id_tanggal_panen}/{id_anggota_tervalidasi}', [DataPanenAnggotaApiControllers::class, 'updateData']);
// Route::delete('/data-panen-anggota/delete/{id_tanggal_panen}/{id_anggota_tervalidasi}', [DataPanenAnggotaApiControllers::class, 'delete']);





/**
 * API MANDOR
 */
Route::get('/tanggal-panen-mandor/{id_superadmin}', [TanggalPanenMandorApiControllers::class, 'index']);

Route::get('/data-spb/{id_tanggal_panen}', [DataSpbMandorApiControllers::class, 'index']);
Route::get('/data-spb-check/{id_superadmin}', [DataSpbMandorApiControllers::class, 'drop']);
Route::post('/data-spb/createData/{id_tanggal_panen}', [DataSpbMandorApiControllers::class, 'createData']);
Route::get('/data-spb/{id_tanggal_panen}/{id_data_spb}', [DataSpbMandorApiControllers::class, 'getUpdateData']);
Route::put('/data-spb/{id_tanggal_panen}/{id_data_spb}', [DataSpbMandorApiControllers::class, 'updateData']);
Route::delete('/data-spb/{id_tanggal_panen}/{id_data_spb}', [DataSpbMandorApiControllers::class, 'delete']);