<?php

namespace App\Http\Controllers\Api\Mandor;

use App\Http\Controllers\Controller;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Auth;

class TanggalPanenMandorApiControllers extends Controller
{
    public function index()
    {
        try {
            $tanggalpanen = TanggalPanenKelompokModels::select('tb_tanggal_panen.*', 'tb_kelompok.nama_kelompok', 'tb_kelompok.id_kelompok')
                ->join('tb_kelompok', 'tb_tanggal_panen.id_kelompok', '=', 'tb_kelompok.id_kelompok')
                // ->where('tb_tanggal_panen.id_superadmin', $userId)
                ->orderBy('id_tanggal_panen', 'desc')
                ->get();

            return response()->json(['success' => true, 'data' => $tanggalpanen], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

