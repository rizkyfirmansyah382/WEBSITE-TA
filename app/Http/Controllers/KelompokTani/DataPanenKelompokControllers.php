<?php

namespace App\Http\Controllers\KelompokTani;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\DataPanenKelompokModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class DataPanenKelompokControllers extends Controller
{
    function index($id_tanggal_panen)
    {
        $datapanen = DataPanenKelompokModels::select('tb_data_panen_kelompok.*', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('tb_data_panen_kelompok.id_tanggal_panen', $id_tanggal_panen)
            ->orderBy('id_data_panen_kelompok', 'desc')
            ->get();
        return view("kelompoktani.datapanenkelompok.anggota.index", ['datapanen' => $datapanen, 'id_tanggal_panen' => $id_tanggal_panen]);
    }

    function create($id_tanggal_panen)
    {
        $id_kelompok = DB::table('tb_tanggal_panen')->where('id_tanggal_panen', $id_tanggal_panen)->value('id_kelompok');
        $nama_anggota = AnggotaTervalidasiAdminModels::select('nama_anggota', 'id_anggota_tervalidasi')
            ->where('id_kelompok', $id_kelompok)
            ->get();
        return view('kelompoktani.datapanenkelompok.anggota.create', compact('nama_anggota', 'id_tanggal_panen'));
    }

    function createData(Request $request, $id_tanggal_panen)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota_tervalidasi' => 'required|numeric',
            'tonase_panen' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect("/data-panen-kelompok/{$id_tanggal_panen}")->with('error', 'Data Gagal Disimpan');
        }

        $id_kelompok = AnggotaTervalidasiAdminModels::where('id_anggota_tervalidasi', $request->input('id_anggota_tervalidasi'))
            ->value('id_kelompok');

        $AdminId = Auth::user()->id_superadmin;
        DataPanenKelompokModels::create([
            'id_kelompok' => $id_kelompok,
            'id_tanggal_panen' => $id_tanggal_panen,
            'id_superadmin' => $AdminId,
            'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
            'tonase_anggota' => $request->input('tonase_panen'),
        ]);
        return redirect("/data-panen-kelompok/{$id_tanggal_panen}")->with('success', 'Data panen berhasil ditambahkan.');
    }

    public function update($id_tanggal_panen, $id_anggota_tervalidasi)
    {
        $id_kelompok = DB::table('tb_tanggal_panen')->where('id_tanggal_panen', $id_tanggal_panen)->value('id_kelompok');
        $nama_anggota = AnggotaTervalidasiAdminModels::select('nama_anggota', 'id_anggota_tervalidasi')
            ->where('id_kelompok', $id_kelompok)
            ->get();

        $panenanggota = DataPanenKelompokModels::
            where('id_tanggal_panen', $id_tanggal_panen)
            ->where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
            ->first();
        return view(
            'kelompoktani.datapanenkelompok.anggota.update',
            compact(
                'panenanggota',
                'nama_anggota',
                'id_tanggal_panen',
            )
        );
    }

    public function updateData(Request $request, $id_tanggal_panen, $id_anggota_tervalidasi)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota_tervalidasi' => 'required|numeric',
            'tonase_panen' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect("/data-panen-kelompok/{$id_tanggal_panen}")->with('error', 'Data panen gagal diperbarui.');
        }

        DataPanenKelompokModels::where('id_tanggal_panen', $id_tanggal_panen)
            ->where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
            ->update([
                'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
                'tonase_anggota' => $request->input('tonase_panen'),
            ]);

        return redirect("/data-panen-kelompok/{$id_tanggal_panen}")->with('success', 'Data panen berhasil diperbarui.');
    }

    public function delete(Request $request, $id_tanggal_panen, $id_anggota_tervalidasi)
    {

        DataPanenKelompokModels::where('id_tanggal_panen', $id_tanggal_panen)
            ->where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
            ->delete();

        return redirect("/data-panen-kelompok/{$id_tanggal_panen}")->with('success', 'Data panen berhasil dihapus.');
    }

    public function checkDataPanencreate(Request $request, $id_tanggal_panen)
    {
        $idAnggota = $request->input('id_anggota_tervalidasi');
        $tonase = $request->input('tonase_panen');
        $isUnique = DataPanenKelompokModels::where('id_anggota_tervalidasi', $idAnggota)
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }
    public function checkDataPanenupdate(Request $request, $id_tanggal_panen)
    {
        $idAnggota = $request->input('id_anggota_tervalidasi');
        $tonase = $request->input('tonase_panen');
        $isUnique = DataPanenKelompokModels::where('id_anggota_tervalidasi', $idAnggota)
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->where('id_tanggal_panen', '!=', $id_tanggal_panen)
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }

}
