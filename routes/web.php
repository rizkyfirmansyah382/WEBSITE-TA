<?php

use App\Http\Controllers\Admin\CheckDataTruckAdminControllers;
use App\Http\Controllers\Admin\DataAnggotaLamaControllers;
use App\Http\Controllers\Admin\DataPemetaanControllers;
use App\Http\Controllers\Admin\HasilPksHarianControllers;
use App\Http\Controllers\Admin\InputHasilPksAdminControllers;
use App\Http\Controllers\Admin\LaporanPanenAnggotaKelompok;
use App\Http\Controllers\Admin\LaporanRekapPanenBulananControllers;
use App\Http\Controllers\Admin\LihatTonaseHarianControllers;
use App\Http\Controllers\Admin\PemetaanControllers;
use App\Http\Controllers\Admin\RekapPanenBulananControllers;
use App\Http\Controllers\Admin\SelisihPanenHarianControllers;
use App\Http\Controllers\Admin\TonasePanenHarianControllers;
use App\Http\Controllers\Admin\VerifikasiAnggotaBaruControllers;
use App\Http\Controllers\HakAksesControllers;
use App\Http\Controllers\KelompokTani\DaftarAnggotaBaruControllers;
use App\Http\Controllers\KelompokTani\RekapBulananControllers;
use App\Http\Controllers\LoginControllers;
use App\Http\Controllers\LoginKeduaControllers;
use App\Http\Controllers\Mandor\DataSpbMandorControllers;
use App\Http\Controllers\SuperAdmin\DashboardSuperAdminControllers;
use App\Http\Controllers\SuperAdmin\LaporanPanenUuoControllers;
use App\Http\Controllers\SuperAdmin\RoleSuperAdminControllers;
use App\Http\Controllers\SuperAdmin\UserSuperAdminControllers;
use App\Http\Controllers\Admin\AnggotaTervalidasiAdminControllers;
use App\Http\Controllers\Admin\BlokAdminControllers;
use App\Http\Controllers\Admin\DashboardAdminControllers;
use App\Http\Controllers\Admin\KelompokAdminControllers;
use App\Http\Controllers\Admin\KendaraanAdminControllers;
use App\Http\Controllers\Admin\RoleAdminControllers;
use App\Http\Controllers\Admin\SopirAdminControllers;
use App\Http\Controllers\Admin\UserAdminControllers;
use App\Http\Controllers\KelompokTani\DashboardKelompokTaniControllers;
use App\Http\Controllers\KelompokTani\DataPanenKelompokControllers;
use App\Http\Controllers\KelompokTani\TanggalPanenKelompokControllers;
use App\Http\Controllers\Mandor\DashboardMandorControllers;
use App\Http\Controllers\Mandor\TanggalPanenMandorControllers;
use App\Http\Controllers\UmumControllers;
use Illuminate\Support\Facades\Route;


Route::get('/forget', function () {
    return view('index');
});


Route::get('/create-symlink', function () {
    $target = base_path('/public/daftaranggotaterbaru');
    $link = ('/home/rizkyfi1/public_html');

    $output = shell_exec("ln -s $target $link 2>&1");

    if (is_null($output)) {
        return "Symlink created successfully.";
    } else {
        return "Error creating symlink: $output";
    }
});


/**
 * Untuk Halaman Umum Untuk WEB
 */

Route::get('/', [UmumControllers::class, 'beranda']);

Route::get('/pemetaan', [PemetaanControllers::class, 'index']);

Route::get('/pilih-hak-akses', [HakAksesControllers::class, 'HakAkses']);

Route::get('/login', [LoginControllers::class, 'index'])->name('superadmin.login');
Route::post('/login', [LoginControllers::class, 'authLogin']);

Route::get('/login-kedua', [LoginKeduaControllers::class, 'index'])->name('admin.login');
Route::post('/login-kedua', [LoginKeduaControllers::class, 'authLoginDua']);


Route::middleware('auth:web')->group(function () {
    Route::middleware('check.user:1')->group(function () {
        Route::get('/dashboard-super-admin', [DashboardSuperAdminControllers::class, 'index']);

        Route::get('/role-super-admin', [RoleSuperAdminControllers::class, 'index']);
        Route::get('/role-super-admin/create', [RoleSuperAdminControllers::class, 'create']);
        Route::post('/role-super-admin/createData', [RoleSuperAdminControllers::class, 'createData']);
        Route::get('/role-super-admin/{id_role}/update', [RoleSuperAdminControllers::class, 'update']);
        Route::put('/role-super-admin/{id_role}/updateData', [RoleSuperAdminControllers::class, 'updateData']);
        Route::get('/role-super-admin/{id_role}/delete', [RoleSuperAdminControllers::class, 'delete']);

        Route::get('/user-super-admin', [UserSuperAdminControllers::class, 'index']);
        Route::get('/user-super-admin/create', [UserSuperAdminControllers::class, 'create']);
        Route::post('/user-super-admin/createData', [UserSuperAdminControllers::class, 'createData']);
        Route::post('/user-super-admin/checkUsername', [UserSuperAdminControllers::class, 'checkUsername']);
        Route::get('/user-super-admin/{id}/update', [UserSuperAdminControllers::class, 'update']);
        Route::put('/user-super-admin/{id}/updateData', [UserSuperAdminControllers::class, 'updateData']);
        Route::get('/user-super-admin/{id}/delete', [UserSuperAdminControllers::class, 'delete']);

        Route::get('/laporan-panen-uuo', [LaporanPanenUuoControllers::class, 'index']);
        Route::get('/laporan-panen-uuo/pilih-bulan/{id}', [LaporanPanenUuoControllers::class, 'pilihBulan']);
        Route::get('/laporan-panen-uuo/pilih-bulan/checkLaporan/{id_tanggal_panen}', [LaporanPanenUuoControllers::class, 'checkLaporan']);

        Route::get('/logout', [LoginControllers::class, 'logout']);
    });

    Route::middleware('check.user:2')->group(function () {
        Route::get('/dashboard-admin', [DashboardAdminControllers::class, 'index']);

        Route::get('/role-admin', [RoleAdminControllers::class, 'index']);
        Route::get('/role-admin/create', [RoleAdminControllers::class, 'create']);
        Route::post('/role-admin/createData', [RoleAdminControllers::class, 'createData']);
        Route::get('/role-admin/{id_role_admin}/update', [RoleAdminControllers::class, 'update']);
        Route::post('/role-admin/{id_role_admin}/updateData', [RoleAdminControllers::class, 'updateData']);
        Route::get('/role-admin/{id_role_admin}/delete', [RoleAdminControllers::class, 'delete']);

        Route::get('/user-admin', [UserAdminControllers::class, 'index']);
        Route::get('/user-admin/create', [UserAdminControllers::class, 'create']);
        Route::post('/user-admin/createData', [UserAdminControllers::class, 'createData']);
        Route::post('/user-admin/checkUsername', [UserAdminControllers::class, 'checkUsername']);
        Route::get('/user-admin/{id}/update', [UserAdminControllers::class, 'update']);
        Route::put('/user-admin/{id}/updateData', [UserAdminControllers::class, 'updateData']);
        Route::get('/user-admin/{id}/delete', [UserAdminControllers::class, 'delete']);

        Route::get('/sopir-admin', [SopirAdminControllers::class, 'index']);
        Route::get('/sopir-admin/create', [SopirAdminControllers::class, 'create']);
        Route::post('/sopir-admin/createData', [SopirAdminControllers::class, 'createData']);
        Route::get('/sopir-admin/{id_sopir}/update', [SopirAdminControllers::class, 'update']);
        Route::put('/sopir-admin/{id_sopir}/updateData', [SopirAdminControllers::class, 'updateData']);
        Route::get('/sopir-admin/{id_sopir}/delete', [SopirAdminControllers::class, 'delete']);

        Route::get('/kendaraan-admin', [KendaraanAdminControllers::class, 'index']);
        Route::get('/kendaraan-admin/create', [KendaraanAdminControllers::class, 'create']);
        Route::post('/kendaraan-admin/createData', [KendaraanAdminControllers::class, 'createData']);
        Route::get('/kendaraan-admin/{id_kendaraan}/update', [KendaraanAdminControllers::class, 'update']);
        Route::put('/kendaraan-admin/{id_kendaraan}/updateData', [KendaraanAdminControllers::class, 'updateData']);
        Route::get('/kendaraan-admin/{id_kendaraan}/delete', [KendaraanAdminControllers::class, 'delete']);

        Route::get('/blok-admin', [BlokAdminControllers::class, 'index']);
        Route::get('/blok-admin/create', [BlokAdminControllers::class, 'create']);
        Route::post('/blok-admin/createData', [BlokAdminControllers::class, 'createData']);
        Route::get('/blok-admin/{id_blok}/update', [BlokAdminControllers::class, 'update']);
        Route::put('/blok-admin/{id_blok}/updateData', [BlokAdminControllers::class, 'updateData']);
        Route::get('/blok-admin/{id_blok}/delete', [BlokAdminControllers::class, 'delete']);

        Route::get('/kelompok-admin', [KelompokAdminControllers::class, 'index']);
        Route::get('/kelompok-admin/create', [KelompokAdminControllers::class, 'create']);
        Route::post('/kelompok-admin/createData', [KelompokAdminControllers::class, 'createData']);
        Route::get('/kelompok-admin/{id_kelompok}/update', [KelompokAdminControllers::class, 'update']);
        Route::put('/kelompok-admin/{id_kelompok}/updateData', [KelompokAdminControllers::class, 'updateData']);
        Route::get('/kelompok-admin/{id_kelompok}/delete', [KelompokAdminControllers::class, 'delete']);

        Route::get('/anggota-tervalidasi', [AnggotaTervalidasiAdminControllers::class, 'index']);
        Route::get('/anggota-tervalidasi/create', [AnggotaTervalidasiAdminControllers::class, 'create']);
        Route::post('/anggota-tervalidasi/createData', [AnggotaTervalidasiAdminControllers::class, 'createData']);
        Route::post('/anggota-tervalidasi/checkNoanggota', [AnggotaTervalidasiAdminControllers::class, 'checkNoanggota']);
        Route::get('/anggota-tervalidasi/{id_anggota_tervalidasi}/update', [AnggotaTervalidasiAdminControllers::class, 'update']);
        Route::put('/anggota-tervalidasi/{id_anggota_tervalidasi}/updateData', [AnggotaTervalidasiAdminControllers::class, 'updateData']);
        Route::get('/anggota-tervalidasi/{id_anggota_tervalidasi}/delete', [AnggotaTervalidasiAdminControllers::class, 'delete']);

        Route::get('/verifikasi-anggota-baru', [VerifikasiAnggotaBaruControllers::class, 'index']);
        Route::get('/verifikasi-anggota-baru/{id_anggota_tervalidasi}/{id_daftar_anggota_baru}/verifikasi', [VerifikasiAnggotaBaruControllers::class, 'verifikasi']);
        Route::post('/verifikasi-anggota-baru/{id_anggota_tervalidasi}/{id_daftar_anggota_baru}/verifikasiData', [VerifikasiAnggotaBaruControllers::class, 'verifikasiData']);

        Route::get('/data-pemetaan', [DataPemetaanControllers::class, 'index']);
        Route::get('/data-pemetaan/{id_anggota_tervalidasi}', [PemetaanControllers::class, 'index2']);
        Route::get('/data-pemetaan/{id_anggota_tervalidasi}/create', [PemetaanControllers::class, 'create']);
        Route::post('/data-pemetaan/{id_anggota_tervalidasi}/createData', [PemetaanControllers::class, 'createData']);
        Route::get('/data-pemetaan/{id_anggota_tervalidasi}/update', [PemetaanControllers::class, 'update']);
        Route::get('/data-pemetaan/{id_anggota_tervalidasi}/delete', [PemetaanControllers::class, 'delete']);
        Route::get('/data-pemetaan/{id_anggota_tervalidasi}/edit    ', [PemetaanControllers::class, 'edit'])->name('polygon.edit');

        Route::get('/data-anggota-lama', [DataAnggotaLamaControllers::class, 'index']);

        Route::get('/tonase-panen-harian', [TonasePanenHarianControllers::class, 'index']);

        Route::get('/lihat-tonase/{id_tanggal_panen}', [LihatTonaseHarianControllers::class, 'index']);

        Route::get('/hasil-pks-harian', [HasilPksHarianControllers::class, 'index']);

        Route::get('/check-data-truck/{id_tanggal_panen}', [CheckDataTruckAdminControllers::class, 'index']);

        Route::get('/rekap-panen-bulanan', [RekapPanenBulananControllers::class, 'index']);
        Route::get('/rekap-panen-bulanan/{id_tanggal_panen}', [RekapPanenBulananControllers::class, 'checkRekap']);
        Route::get('/rekap-panen-bulanan/checkData/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [RekapPanenBulananControllers::class, 'checkData']);
        Route::get('/rekap-panen-bulanan/checkData/update/{id_data_panen_kelompok}/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [RekapPanenBulananControllers::class, 'update']);
        Route::put('/rekap-panen-bulanan/checkData/updateData/{id_data_panen_kelompok}/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [RekapPanenBulananControllers::class, 'updateData']);

        Route::get('/input-hasil-pks/{id_data_spb}/{id_tanggal_panen}', [InputHasilPksAdminControllers::class, 'index']);
        Route::get('/input-hasil-pks/create/{id_data_spb}/{id_tanggal_panen}', [InputHasilPksAdminControllers::class, 'create']);
        Route::post('/input-hasil-pks/createData/{id_data_spb}/{id_tanggal_panen}', [InputHasilPksAdminControllers::class, 'createData']);
        Route::get('/input-hasil-pks/{id_data_spb}/{id_tanggal_panen}/update', [InputHasilPksAdminControllers::class, 'update']);
        Route::put('/input-hasil-pks/{id_data_spb}/{id_tanggal_panen}/updateData', [InputHasilPksAdminControllers::class, 'updateData']);

        Route::get('/laporan-panen-anggota-kelompok', [LaporanPanenAnggotaKelompok::class, 'index']);
        Route::get('/laporan-panen-anggota-kelompok/pilih-bulan/{id_kelompok}', [LaporanPanenAnggotaKelompok::class, 'pilihbulan']);
        Route::get('/laporan-panen-anggota-kelompok/check-laporan/{id_tanggal_panen}', [LaporanPanenAnggotaKelompok::class, 'checklaporan']);
        Route::get('admin/laporan/download/{id_kelompok}/{periodeBulan}/{periodeTahun}', [LaporanPanenAnggotaKelompok::class, 'downloadLaporan']);
        Route::get('admin/laporan/downloadExcel/{id_kelompok}/{periodeBulan}/{periodeTahun}', [LaporanPanenAnggotaKelompok::class, 'downloadExcel']);

        Route::get('/selisih-panen-harian', [SelisihPanenHarianControllers::class, 'index']);
        Route::get('/selisih-panen-harian/pilih-tanggal/{id_kelompok}', [SelisihPanenHarianControllers::class, 'pilihTanggal']);
        Route::get('/selisih-panen-harian/check-selisih/{id_tanggal_panen}/{id_kelompok}', [SelisihPanenHarianControllers::class, 'checkselisih']);
        Route::get('/selisih-panen-harian/download/{id_tanggal_panen}/{id_kelompok}', [SelisihPanenHarianControllers::class, 'downloadLaporan']);
        Route::get('/selisih-panen-harian/downloadExcel/{id_tanggal_panen}/{id_kelompok}', [SelisihPanenHarianControllers::class, 'downloadExcel']);

        Route::get('/laporan-rekap-panen-bulanan', [LaporanRekapPanenBulananControllers::class, 'index']);
        Route::get('/laporan-rekap-panen-bulanan/{id_tanggal_panen}', [LaporanRekapPanenBulananControllers::class, 'checkRekap']);
        Route::get('/laporan-rekap-panen-bulanan/checkData/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [LaporanRekapPanenBulananControllers::class, 'checkData']);
        Route::get('/laporan-rekap-panen-bulanan/checkData/download/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [LaporanRekapPanenBulananControllers::class, 'downloadPDF']);
        Route::get('/laporan/rekappanenbulanan/download/excel/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [LaporanRekapPanenBulananControllers::class, 'downloadExcel']);

        Route::get('/logout', [LoginControllers::class, 'logout']);
    });


});



Route::middleware('auth:admin')->group(function () {
    Route::middleware('check.admin:1')->group(function () {
        Route::get('/dashboard-kelompok-tani', [DashboardKelompokTaniControllers::class, 'index']);

        Route::post('/check-data/tgl-panen', [TanggalPanenKelompokControllers::class, 'checkTglPanen']);
        Route::get('/tanggal-panen-kelompok', [TanggalPanenKelompokControllers::class, 'index']);
        Route::get('/tanggal-panen-kelompok/create', [TanggalPanenKelompokControllers::class, 'create']);
        Route::post('/tanggal-panen-kelompok/createData', [TanggalPanenKelompokControllers::class, 'createData']);
        Route::get('/tanggal-panen-kelompok/{id_tanggal_panen}/update', [TanggalPanenKelompokControllers::class, 'update']);
        Route::put('/tanggal-panen-kelompok/{id_tanggal_panen}/updateData', [TanggalPanenKelompokControllers::class, 'updateData']);
        Route::get('/tanggal-panen-kelompok/{id_tanggal_panen}/delete', [TanggalPanenKelompokControllers::class, 'delete']);

        Route::get('/rekap-bulanan', [RekapBulananControllers::class, 'index']);
        Route::get('/rekap-bulanan/{id_tanggal_panen}', [RekapBulananControllers::class, 'checkRekap']);
        Route::get('/rekap-bulanan/checkData/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [RekapBulananControllers::class, 'checkData']);
        Route::get('/rekap-bulanan/checkData/update/{id_data_panen_kelompok}/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [RekapBulananControllers::class, 'update']);
        Route::put('/rekap-bulanan/checkData/updateData/{id_data_panen_kelompok}/{id_tanggal_panen}/{id_tanggal_panen_revisi}', [RekapBulananControllers::class, 'updateData']);

        Route::post('/check-data/data-panen-create/{id_tanggal_panen}', [DataPanenKelompokControllers::class, 'checkDataPanencreate']);
        Route::post('/check-data/data-panen-update/{id_tanggal_panen}', [DataPanenKelompokControllers::class, 'checkDataPanenupdate']);
        Route::get('/data-panen-kelompok/{id_tanggal_panen}', [DataPanenKelompokControllers::class, 'index']);
        Route::get('/data-panen-kelompok/create/{id_tanggal_panen}', [DataPanenKelompokControllers::class, 'create']);
        Route::post('/data-panen-kelompok/createData/{id_tanggal_panen}', [DataPanenKelompokControllers::class, 'createData']);
        Route::get('/data-panen-kelompok/{id_tanggal_panen}/{id_anggota_tervalidasi}/update', [DataPanenKelompokControllers::class, 'update']);
        // Route::get('/data-panen-kelompok/{id_tanggal_panen}/{id_anggota_tervalidasi}/update', [DataPanenKelompokControllers::class, 'update']);
        Route::put('/data-panen-kelompok/{id_tanggal_panen}/{id_anggota_tervalidasi}/updateData', [DataPanenKelompokControllers::class, 'updateData']);
        Route::get('/data-panen-kelompok/{id_tanggal_panen}/{id_anggota_tervalidasi}/delete', [DataPanenKelompokControllers::class, 'delete']);

        Route::get('/daftar-anggota-baru', [DaftarAnggotaBaruControllers::class, 'index']);
        Route::get('/daftar-anggota-baru/create', [DaftarAnggotaBaruControllers::class, 'create']);
        Route::post('/daftar-anggota-baru/createData', [DaftarAnggotaBaruControllers::class, 'createData']);
        Route::get('/daftar-anggota-baru/{id_daftar_anggota_baru}/update', [DaftarAnggotaBaruControllers::class, 'update']);
        Route::put('/daftar-anggota-baru/{id_daftar_anggota_baru}/updateData', [DaftarAnggotaBaruControllers::class, 'updateData']);
        Route::get('/daftar-anggota-baru/{id_daftar_anggota_baru}/delete', [DaftarAnggotaBaruControllers::class, 'delete']);
        Route::get('/daftar-anggota-baru/getMembers/{id_kelompok}', [DaftarAnggotaBaruControllers::class, 'getMembers']);

        Route::get('/logout-kedua', [LoginKeduaControllers::class, 'logout']);
    });

    Route::middleware('check.admin:2')->group(function () {
        Route::get('/dashboard-mandor', [DashboardMandorControllers::class, 'index']);

        Route::get('/tanggal-panen-kelompok-mandor', [TanggalPanenMandorControllers::class, 'index']);

        Route::get('/data-spb/{id_tanggal_panen}', [DataSpbMandorControllers::class, 'index']);
        Route::get('/data-spb/create/{id_tanggal_panen}', [DataSpbMandorControllers::class, 'create']);
        Route::post('/data-spb/createData/{id_tanggal_panen}', [DataSpbMandorControllers::class, 'createData']);
        Route::post('/data-spb/checkNospb/{id_tanggal_panen}', [DataSpbMandorControllers::class, 'checkNospb']);
        Route::get('/data-spb/{id_tanggal_panen}/{id_data_spb}/update', [DataSpbMandorControllers::class, 'update']);
        Route::put('/data-spb/{id_tanggal_panen}/{id_data_spb}/updateData', [DataSpbMandorControllers::class, 'updateData']);
        Route::get('/data-spb/{id_tanggal_panen}/{id_data_spb}/delete', [DataSpbMandorControllers::class, 'delete']);

        Route::get('/logout-kedua', [LoginKeduaControllers::class, 'logout']);
    });
});