<?php

namespace App\Http\Controllers\Mandor;

use App\Http\Controllers\Controller;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Auth;

class TanggalPanenMandorControllers extends Controller
{
    function index()
    {
        $UserId = Auth::user()->id_superadmin;
        $tanggalpanen = TanggalPanenKelompokModels::select('tb_tanggal_panen.*', 'tb_kelompok.nama_kelompok')
            ->join('tb_kelompok', 'tb_tanggal_panen.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->where('tb_tanggal_panen.id_superadmin', $UserId)
            ->orderBy('tb_tanggal_panen.tgl_panen', 'desc')
            ->paginate(10);
        return view('mandor.datapanenkelompok.tanggalpanen.index', compact('tanggalpanen'));
    }
}
