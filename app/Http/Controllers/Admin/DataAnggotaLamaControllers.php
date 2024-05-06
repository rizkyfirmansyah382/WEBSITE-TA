<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataAnggotaLamaModels;
use Illuminate\Http\Request;
use Auth;

class DataAnggotaLamaControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id;
        $anggotalama = DataAnggotaLamaModels::select('tb_data_anggota_lama.*', 'tb_kelompok.nama_kelompok')
            ->join('tb_kelompok', 'tb_data_anggota_lama.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->where('tb_data_anggota_lama.id_superadmin', $adminId)
            ->get();
        return view('admin.dataanggota.dataanggotalama.index', compact('anggotalama'));

    }
}
