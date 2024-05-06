<?php

namespace App\Http\Controllers\KelompokTani;

use App\Http\Controllers\Controller;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Auth;

class TanggalPanenKelompokControllers extends Controller
{
    function index()
    {
        $UserId = Auth::user()->id_superadmin;
        $tanggalpanen = TanggalPanenKelompokModels::select('tb_tanggal_panen.*', 'tb_kelompok.nama_kelompok')
            ->join('tb_kelompok', 'tb_tanggal_panen.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->where('tb_tanggal_panen.id_superadmin', $UserId)
            ->orderBy('tb_tanggal_panen.tgl_panen', 'desc')
            ->paginate(10);
        return view('kelompoktani.datapanenkelompok.tanggalpanen.index', compact('tanggalpanen'));
    }

    function create()
    {
        $UserId = Auth::user()->id_superadmin;
        $kelompok = KelompokAdminModels::where('id_superadmin', $UserId)->get();
        return view('kelompoktani.datapanenkelompok.tanggalpanen.create', compact('kelompok'));
    }

    function createData(Request $request)
    {
        $UserId = Auth::user()->id_superadmin;
        TanggalPanenKelompokModels::create([
            'id_superadmin' => $UserId,
            'id_kelompok' => $request->input('id_kelompok'),
            'tgl_panen' => $request->input('tgl_panen'),
        ]);
        return redirect("/tanggal-panen-kelompok")->with('success', 'Tanggal berhasil ditambahkan.');
    }

    function update($id_tanggal_panen)
    {
        $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $UserId = Auth::user()->id_superadmin;
        $kelompok = KelompokAdminModels::where('id_superadmin', $UserId)->get();
        return view('kelompoktani.datapanenkelompok.tanggalpanen.update', compact('tanggal', 'kelompok'));
    }

    function updateData(Request $request, $id_tanggal_panen)
    {
        $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $tanggal->id_kelompok = $request->input('id_kelompok');
        $tanggal->tgl_panen = $request->input('tgl_panen');
        $tanggal->save();
        return redirect("/tanggal-panen-kelompok")->with('success', 'Tanggal berhasil diperbarui.');
    }
    function delete(Request $request, $id_tanggal_panen)
    {
        $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $tanggal->delete();
        return redirect("/tanggal-panen-kelompok")->with('success', 'Tanggal berhasil dihapus.');
    }

    public function checkTglPanen(Request $request)
    {
        $idKelompok = $request->input('id_kelompok');
        $tglPanen = $request->input('tgl_panen');

        // Check keunikan tanggal panen untuk kelompok tertentu
        $isUnique = TanggalPanenKelompokModels::where('id_kelompok', $idKelompok)
            ->where('tgl_panen', $tglPanen)
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }
}
