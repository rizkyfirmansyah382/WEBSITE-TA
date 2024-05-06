<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HasilPksHarianControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id;
        $tanggalpanen = \App\Models\TanggalPanenKelompokModels::select('tb_tanggal_panen.*', 'tb_kelompok.nama_kelompok')
            ->join('tb_kelompok', 'tb_tanggal_panen.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->where('tb_tanggal_panen.id_superadmin', $adminId)
            ->orderBy('tb_tanggal_panen.tgl_panen', 'desc')
            ->paginate(10);
        return view('admin.datapanenanggota.hasilpks.index', compact('tanggalpanen'));
    }
}
