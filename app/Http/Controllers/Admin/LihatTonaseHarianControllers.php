<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPanenKelompokModels;
use Illuminate\Http\Request;

class LihatTonaseHarianControllers extends Controller
{
    function index($id_tanggal_panen)
    {
        $datapanen = DataPanenKelompokModels::select('tb_data_panen_kelompok.*', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('tb_data_panen_kelompok.id_tanggal_panen', $id_tanggal_panen)
            ->get();
        return view("admin.datapanenanggota.tonaseharian.lihattonase.index", ['datapanen' => $datapanen, 'id_tanggal_panen' => $id_tanggal_panen]);
    }
}
