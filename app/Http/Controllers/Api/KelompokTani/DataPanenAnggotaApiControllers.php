<?php

namespace App\Http\Controllers\Api\KelompokTani;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\DataPanenKelompokModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataPanenAnggotaApiControllers extends Controller
{
    public function index($id_tanggal_panen)
    {
        $datapanen = DataPanenKelompokModels::select('tb_data_panen_kelompok.*', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('tb_data_panen_kelompok.id_tanggal_panen', $id_tanggal_panen)
            ->get();

        return response()->json(['datapanen' => $datapanen, 'id_tanggal_panen' => $id_tanggal_panen]);
    }

    public function create($id_tanggal_panen)
    {
        try {
            $id_kelompok = DB::table('tb_tanggal_panen')->where('id_tanggal_panen', $id_tanggal_panen)->value('id_kelompok');

            $nama_anggota = AnggotaTervalidasiAdminModels::select('nama_anggota', 'id_anggota_tervalidasi')
                ->where('id_kelompok', $id_kelompok)
                ->get();

            return response()->json([
                'nama_anggota' => $nama_anggota,
                'id_tanggal_panen' => $id_tanggal_panen,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error occurred while fetching data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function createData(Request $request, $id_tanggal_panen)
    {
        $validator = Validator::make($request->all(), [
            'id_anggota_tervalidasi' => 'required|numeric',
            'tonase_anggota' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Data Gagal Disimpan'], 400);
        }

        $id_kelompok = AnggotaTervalidasiAdminModels::where('id_anggota_tervalidasi', $request->input('id_anggota_tervalidasi'))
            ->value('id_kelompok');


        DataPanenKelompokModels::create([
            'id_kelompok' => $id_kelompok,
            'id_tanggal_panen' => $id_tanggal_panen,
            'id_superadmin' => $request->input('id_superadmin'),
            'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
            'tonase_anggota' => $request->input('tonase_anggota'),
        ]);

        return response()->json(['message' => 'Data panen berhasil ditambahkan'], 201);
    }

    public function update($id_tanggal_panen, $id_anggota_tervalidasi)
    {
        try {
            $panenanggota = DataPanenKelompokModels::where('id_tanggal_panen', $id_tanggal_panen)
                ->where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
                ->first();

            return response()->json([
                'panenanggota' => $panenanggota,
                'id_tanggal_panen' => $id_tanggal_panen,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateData(Request $request, $id_tanggal_panen, $id_anggota_tervalidasi)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_anggota_tervalidasi' => 'required|numeric',
                'tonase_panen' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Data panen gagal diperbarui.'], 400);
            }

            DataPanenKelompokModels::where('id_tanggal_panen', $id_tanggal_panen)
                ->where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
                ->update([
                    'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
                    'tonase_anggota' => $request->input('tonase_panen'),
                ]);

            return response()->json(['message' => 'Data panen berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id_tanggal_panen, $id_anggota_tervalidasi)
    {
        try {
            DataPanenKelompokModels::where('id_tanggal_panen', $id_tanggal_panen)
                ->where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
                ->delete();

            return response()->json(['message' => 'Data panen berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data panen.'], 500);
        }
    }

}
