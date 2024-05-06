<?php

namespace App\Http\Controllers\Api\KelompokTani;

use App\Http\Controllers\Controller;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class TanggalPanenKelompokApiControllers extends Controller
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

    public function getKelompok($id_superadmin)
    {
        $kelompok = KelompokAdminModels::where('id_superadmin', $id_superadmin)->get();
        return response()->json(['kelompok' => $kelompok]);
    }

    public function createData(Request $request)
    {
        try {
            // $userId = Auth::user()->id_superadmin;

            TanggalPanenKelompokModels::create([
                'id_superadmin' => $request->input('id_superadmin'),
                'id_kelompok' => $request->input('id_kelompok'),
                'tgl_panen' => Carbon::createFromFormat('d/m/Y', $request->input('tgl_panen'))->format('Y-m-d'),

            ]);

            return response()->json(['message' => 'Tanggal berhasil ditambahkan.'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update($id_tanggal_panen)
    {
        // $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $kelompok = TanggalPanenKelompokModels::where('id_tanggal_panen', $id_tanggal_panen)->get();

        return response()->json(['kelompok' => $kelompok], 200);
    }

    public function updateData(Request $request, $id_tanggal_panen)
    {
        try {
            $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);

            if (!$tanggal) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $tanggal->id_kelompok = $request->input('id_kelompok');

            // Menggunakan Carbon untuk memanipulasi tanggal
            $tanggal->tgl_panen = Carbon::createFromFormat('d/m/Y', $request->input('tgl_panen'))->format('Y-m-d');

            $tanggal->save();

            return response()->json(['message' => 'Data updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function delete(Request $request, $id_tanggal_panen)
    {
        $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);

        if (!$tanggal) {
            return response()->json(['error' => 'Tanggal not found'], 404);
        }

        $tanggal->delete();

        return response()->json(['success' => 'Tanggal berhasil dihapus.']);
    }
}
