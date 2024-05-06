<?php

namespace App\Http\Controllers\Api\Mandor;

use App\Http\Controllers\Controller;
use App\Models\BlokAdminModels;
use App\Models\DataSpbMandorModels;
use App\Models\KendaraanAdminModels;
use App\Models\SopirAdminModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;


class DataSpbMandorApiControllers extends Controller
{
    public function index($id_tanggal_panen)
    {
        $dataspb = DataSpbMandorModels::select('tb_data_spb.*', 'tb_kelompok.nama_kelompok', 'tb_blok.blok', 'tb_kendaraan.no_polisi', 'tb_sopir.nama_sopir')
            ->join('tb_kelompok', 'tb_data_spb.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_blok', 'tb_data_spb.id_blok', '=', 'tb_blok.id_blok')
            ->join('tb_kendaraan', 'tb_data_spb.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->join('tb_sopir', 'tb_data_spb.id_sopir', '=', 'tb_sopir.id_sopir')
            ->where('tb_data_spb.id_tanggal_panen', $id_tanggal_panen)
            ->get();

        return response()->json($dataspb);
    }

    public function drop($id_superadmin)
    {
        // Fetch data from Blok model
        $blok = BlokAdminModels::where('id_superadmin', $id_superadmin)->pluck('blok', 'id_blok');

        // Fetch data from Sopir model
        $sopir = SopirAdminModels::where('id_superadmin', $id_superadmin)->pluck('nama_sopir', 'id_sopir');

        // Fetch data from Kendaraan model
        $kendaraan = KendaraanAdminModels::where('id_superadmin', $id_superadmin)->pluck('no_polisi', 'id_kendaraan');

        return response()->json([
            'blok' => $blok,
            'sopir' => $sopir,
            'kendaraan' => $kendaraan,
        ]);
    }

    public function createData(Request $request, $id_tanggal_panen)
    {
        $validator = Validator::make($request->all(), [
            'id_sopir' => 'required|numeric',
            'id_blok' => 'required|numeric',
            'id_kendaraan' => 'required|numeric',
            'no_spb' => 'required',
            'total_janjang' => 'required|numeric',
            'tujuan_pks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed.'], 400);
        }
        DataSpbMandorModels::create([
            'id_kelompok' => $request->input('id_kelompok'),
            'id_tanggal_panen' => $request->input('id_tanggal_panen'),
            'id_superadmin' => $request->input('id_superadmin'),
            'id_sopir' => $request->input('id_sopir'),
            'id_blok' => $request->input('id_blok'),
            'id_kendaraan' => $request->input('id_kendaraan'),
            'total_janjang' => $request->input('total_janjang'),
            'no_spb' => $request->input('no_spb'),
            'tujuan_pks' => $request->input('tujuan_pks'),
        ]);

        return response()->json(['success' => true, 'message' => 'Data added successfully.'], 201);
    }

    public function getUpdateData($id_tanggal_panen, $id_data_spb)
    {
        $dataspb = DataSpbMandorModels::select(
            'tb_data_spb.*',
            'tb_kelompok.nama_kelompok',
            'tb_blok.blok',
            'tb_kendaraan.no_polisi',
            'tb_sopir.nama_sopir'
        )
            ->join('tb_kelompok', 'tb_data_spb.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_blok', 'tb_data_spb.id_blok', '=', 'tb_blok.id_blok')
            ->join('tb_kendaraan', 'tb_data_spb.id_kendaraan', '=', 'tb_kendaraan.id_kendaraan')
            ->join('tb_sopir', 'tb_data_spb.id_sopir', '=', 'tb_sopir.id_sopir')
            ->where('tb_data_spb.id_tanggal_panen', $id_tanggal_panen)
            ->where('tb_data_spb.id_data_spb', $id_data_spb)
            ->first();

        if (!$dataspb) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($dataspb);
    }

    public function updateData(Request $request, $id_tanggal_panen, $id_data_spb)
    {
        $validator = Validator::make($request->all(), [
            'id_sopir' => 'required|numeric',
            'id_blok' => 'required|numeric',
            'id_kendaraan' => 'required|numeric',
            'no_spb' => 'required',
            'total_janjang' => 'required|numeric',
            'tujuan_pks' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validation failed.', 'errors' => $validator->errors()], 400);
        }

        $dataspb = DataSpbMandorModels::find($id_data_spb);

        if (!$dataspb) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $dataspb->id_sopir = $request->input('id_sopir');
        $dataspb->id_blok = $request->input('id_blok');
        $dataspb->id_kendaraan = $request->input('id_kendaraan');
        $dataspb->no_spb = $request->input('no_spb');
        $dataspb->total_janjang = $request->input('total_janjang');
        $dataspb->tujuan_pks = $request->input('tujuan_pks');
        $dataspb->save();

        return response()->json(['success' => true, 'message' => 'Data updated successfully', 'data' => $dataspb]);
    }



    public function delete(Request $request, $id_tanggal_panen, $id_data_spb)
    {
        $dataSpb = DataSpbMandorModels::find($id_data_spb);

        if (!$dataSpb) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $dataSpb->delete();

        return response()->json(['message' => 'Surat perintah bongkar berhasil dihapus.']);
    }

    // public function create(Request $request, $id_tanggal_panen)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id_sopir' => 'required|numeric',
    //         'id_blok' => 'required|numeric',
    //         'id_kendaraan' => 'required|numeric',
    //         'no_spb' => 'required',
    //         'total_janjang' => 'required|numeric',
    //         'tujuan_pks' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    //     }

    //     $AdminId = Auth::user()->id_superadmin;
    //     $id_kelompok =

    //     $dataspb = DataSpbMandorModels::create([
    //         'id_kelompok' => $id_kelompok,
    //         'id_tanggal_panen' => $id_tanggal_panen,
    //         'id_superadmin' => $AdminId,
    //         'id_sopir' => $request->input('id_sopir'),
    //         'id_blok' => $request->input('id_blok'),
    //         'id_kendaraan' => $request->input('id_kendaraan'),
    //         'no_spb' => $request->input('no_spb'),
    //         'total_janjang' => $request->input('total_janjang'),
    //         'tujuan_pks' => $request->input('tujuan_pks'),
    //     ]);

    //     return response()->json(['message' => 'Data created successfully', 'data' => $dataspb], 201);
    // }

    // public function update(Request $request, $id_tanggal_panen, $id_data_spb)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id_sopir' => 'required|numeric',
    //         'id_blok' => 'required|numeric',
    //         'id_kendaraan' => 'required|numeric',
    //         'no_spb' => 'required',
    //         'total_janjang' => 'required|numeric',
    //         'tujuan_pks' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    //     }

    //     $dataspb = DataSpbMandorModels::find($id_data_spb);

    //     if (!$dataspb) {
    //         return response()->json(['message' => 'Data not found'], 404);
    //     }

    //     $dataspb->id_sopir = $request->input('id_sopir');
    //     $dataspb->id_blok = $request->input('id_blok');
    //     $dataspb->id_kendaraan = $request->input('id_kendaraan');
    //     $dataspb->no_spb = $request->input('no_spb');
    //     $dataspb->total_janjang = $request->input('total_janjang');
    //     $dataspb->tujuan_pks = $request->input('tujuan_pks');
    //     $dataspb->save();

    //     return response()->json(['message' => 'Data updated successfully', 'data' => $dataspb]);
    // }

    // public function delete(Request $request, $id_tanggal_panen, $id_data_spb)
    // {
    //     $dataspb = DataSpbMandorModels::find($id_data_spb);

    //     if (!$dataspb) {
    //         return response()->json(['message' => 'Data not found'], 404);
    //     }

    //     $dataspb->delete();

    //     return response()->json(['message' => 'Data deleted successfully']);
    // }
}
