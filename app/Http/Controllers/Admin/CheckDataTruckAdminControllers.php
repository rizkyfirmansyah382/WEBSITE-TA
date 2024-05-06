<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSpbMandorModels;
use Illuminate\Http\Request;

class CheckDataTruckAdminControllers extends Controller
{
    function index($id_tanggal_panen)
    {
        $dataspb = DataSpbMandorModels::select('tb_data_spb.*', 'tb_kelompok.nama_kelompok', 'tb_blok.blok', 'tb_kendaraan.no_polisi', 'tb_sopir.nama_sopir')
            ->join('tb_kelompok', 'tb_data_spb.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_blok', 'tb_data_spb.id_blok', '=', 'tb_blok.id_blok')
            ->join('tb_kendaraan', 'tb_data_spb.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->join('tb_sopir', 'tb_data_spb.id_sopir', '=', 'tb_sopir.id_sopir')
            ->where('tb_data_spb.id_tanggal_panen', $id_tanggal_panen)
            ->get();
        return view('admin.datapanenanggota.hasilpks.checkdatatruck.index', compact('id_tanggal_panen', 'dataspb'));
    }
}
