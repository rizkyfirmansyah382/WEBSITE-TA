<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\PemetaanModels;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class PemetaanControllers extends Controller
{
    public function index()
    {
        // Ambil data polygon dari model PemetaanModels dengan JOIN
        $polygons = DB::table('tb_pemetaan')
            ->select('tb_pemetaan.*', 'tb_anggota_tervalidasi.*', 'tb_kelompok.nama_kelompok', 'tb_blok.blok')
            ->leftJoin('tb_anggota_tervalidasi', 'tb_pemetaan.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->leftJoin('tb_kelompok', 'tb_anggota_tervalidasi.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->leftJoin('tb_blok', 'tb_anggota_tervalidasi.id_blok', '=', 'tb_blok.id_blok')
            ->get()
            ->toArray();

        // dd($polygons);
        return view('umum.pemetaan', compact('polygons'));
    }

    public function index2($id_anggota_tervalidasi)
    {
        // $adminId= Auth::user()->id;
        $pemetaan = PemetaanModels::where('id_anggota_tervalidasi', $id_anggota_tervalidasi)->get();
        // $pemetaan = PemetaanModels
        return view('admin.dataanggota.datapemetaan.Polygon.index', compact('id_anggota_tervalidasi', 'pemetaan'));
    }
    public function create($id_anggota_tervalidasi)
    {
        $polygon = PemetaanModels::first();
        return view('admin.dataanggota.datapemetaan.Polygon.create', compact('id_anggota_tervalidasi', 'polygon'));
    }

    function createData(Request $request, $id_anggota_tervalidasi)
    {
        $adminId = Auth::user()->id;
        PemetaanModels::create([
            'id_superadmin' => $adminId,
            'id_anggota_tervalidasi' => $id_anggota_tervalidasi,
            'coordinates' => $request->input('coordinates'),
        ]);
        return redirect("/data-pemetaan/{$id_anggota_tervalidasi}");
    }


    public function update($id_anggota_tervalidasi)
    {
        // dd($id_anggota_tervalidasi);
        $polygon = PemetaanModels::first();
        // $data = PemetaanModels::find($id_anggota_tervalidasi);
        $data = PemetaanModels::where('id_anggota_tervalidasi', $id_anggota_tervalidasi)->first();
        // dd($data);
        return view('admin.dataanggota.datapemetaan.Polygon.edit', compact('id_anggota_tervalidasi', 'polygon', 'data'));
    }

    function delete($id_anggota_tervalidasi)
    {
        $data = PemetaanModels::where('id_anggota_tervalidasi', $id_anggota_tervalidasi)->first();
        $data->delete();
        return redirect("/data-pemetaan/{$id_anggota_tervalidasi}")->with('success', 'User berhasil dihapus.');
    }
}
