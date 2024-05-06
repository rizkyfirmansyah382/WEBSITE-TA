<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use Illuminate\Http\Request;
use Auth;

class DataPemetaanControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id;
        $anggotaterValidasi = AnggotaTervalidasiAdminModels::select('tb_anggota_tervalidasi.*', 'tb_kelompok.nama_kelompok', 'tb_blok.blok')
            ->join('tb_kelompok', 'tb_anggota_tervalidasi.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_blok', 'tb_anggota_tervalidasi.id_blok', '=', 'tb_blok.id_blok')
            ->where('tb_anggota_tervalidasi.id_superadmin', $adminId)
            ->get();
        return view('admin.dataanggota.datapemetaan.index', compact('anggotaterValidasi'));
    }
}
