<?php

namespace App\Http\Controllers\Mandor;

use App\Http\Controllers\Controller;
use App\Models\BlokAdminModels;
use App\Models\DataSpbMandorModels;
use App\Models\KendaraanAdminModels;
use App\Models\SopirAdminModels;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataSpbMandorControllers extends Controller
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
        return view('mandor.datapanenkelompok.dataspb.index', compact('id_tanggal_panen', 'dataspb'));
    }

    function create($id_tanggal_panen)
    {
        $AdminId = Auth::user()->id_superadmin;
        $blok = BlokAdminModels::where('id_superadmin', $AdminId)->get();
        $sopir = SopirAdminModels::where('id_superadmin', $AdminId)->get();
        $kendaraan = KendaraanAdminModels::where('id_superadmin', $AdminId)->get();
        return view('mandor.datapanenkelompok.dataspb.create', compact('id_tanggal_panen', 'blok', 'sopir', 'kendaraan'));
    }
    function createData(Request $request, $id_tanggal_panen)
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
            return redirect("data-spb/{$id_tanggal_panen}")->with('error', 'Data Gagal Disimpan');
        }

        $AdminId = Auth::user()->id_superadmin;
        $id_kelompok = DB::table('tb_tanggal_panen')->where('id_tanggal_panen', $id_tanggal_panen)->value('id_kelompok');
        DataSpbMandorModels::create([
            'id_kelompok' => $id_kelompok,
            'id_tanggal_panen' => $id_tanggal_panen,
            'id_superadmin' => $AdminId,
            'id_sopir' => $request->input('id_sopir'),
            'id_blok' => $request->input('id_blok'),
            'id_kendaraan' => $request->input('id_kendaraan'),
            'total_janjang' => $request->input('total_janjang'),
            'no_spb' => $request->input('no_spb'),
            'tujuan_pks' => $request->input('tujuan_pks'),
        ]);
        return redirect("data-spb/{$id_tanggal_panen}")->with('success', 'Surat perintah bongkar berhasil ditambahkan.');
    }
    public function checkNospb(Request $request)
    {
        $no_spb = $request->input('no_spb');
        $userId = $request->input('userId');

        $isUnique = DataSpbMandorModels::where('tb_data_spb.no_spb', $no_spb)
            ->where('id_data_spb', '!=', $userId) // Hindari memeriksa keunikan username untuk pengguna dengan ID yang sedang diupdate
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }

    function update($id_tanggal_panen, $id_data_spb)
    {

        $AdminId = Auth::user()->id_superadmin;
        $blok = BlokAdminModels::where('id_superadmin', $AdminId)->get();
        $sopir = SopirAdminModels::where('id_superadmin', $AdminId)->get();
        $kendaraan = KendaraanAdminModels::where('id_superadmin', $AdminId)->get();
        $dataSpb = DataSpbMandorModels::where('id_tanggal_panen', $id_tanggal_panen)
            ->where('id_data_spb', $id_data_spb)
            ->first();
        return view('mandor.datapanenkelompok.dataspb.update', [
            'id_tanggal_panen' => $id_tanggal_panen,
            'blok' => $blok,
            'sopir' => $sopir,
            'kendaraan' => $kendaraan,
            'dataSpb' => $dataSpb,
        ]);
    }

    function updateData(Request $request, $id_tanggal_panen, $id_data_spb)
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
            return redirect("data-spb/{$id_tanggal_panen}")->with('error', 'Data Gagal Disimpan');
        }

        $dataSpb = DataSpbMandorModels::find($id_data_spb);

        if (!$dataSpb) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        $dataSpb->id_sopir = $request->input('id_sopir');
        $dataSpb->id_blok = $request->input('id_blok');
        $dataSpb->id_kendaraan = $request->input('id_kendaraan');
        $dataSpb->no_spb = $request->input('no_spb');
        $dataSpb->total_janjang = $request->input('total_janjang');
        $dataSpb->tujuan_pks = $request->input('tujuan_pks');

        // Save the updated data
        $dataSpb->save();

        return redirect("data-spb/{$id_tanggal_panen}")->with('success', 'Surat perintah bongkar berhasil diperbarui.');
    }
    function delete(Request $request, $id_tanggal_panen, $id_data_spb)
    {
        $dataSpb = DataSpbMandorModels::find($id_data_spb);
        $dataSpb->delete();
        return redirect("data-spb/{$id_tanggal_panen}")->with('success', 'Surat perintah bongkar berhasil dihapus.');
    }
}
