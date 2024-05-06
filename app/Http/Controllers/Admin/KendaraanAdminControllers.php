<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KendaraanAdminModels;
use Illuminate\Http\Request;
use Auth;

class KendaraanAdminControllers extends Controller
{
    function index()
    {
        $AdminId = Auth::user()->id;
        $kendaraan = KendaraanAdminModels::where('id_superadmin', $AdminId)
            ->get();
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    function create()
    {
        return view('admin.kendaraan.create');
    }

    function createData(Request $request)
    {
        $AdminId = Auth::user()->id;

        KendaraanAdminModels::create([
            'id_superadmin' => $AdminId,
            'no_polisi' => $request->input('no_polisi'),
            'jenis_kendaraan' => $request->input('jenis_kendaraan'),
        ]);
        return redirect('/kendaraan-admin')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    function update($id_kendaraan)
    {
        $kendaraan = KendaraanAdminModels::find($id_kendaraan);
        return view('admin.kendaraan.update', compact('kendaraan'));
    }

    function updateData(Request $request, $id_kendaraan)
    {
        $kendaraan = KendaraanAdminModels::find($id_kendaraan);
        $kendaraan->no_polisi = $request->input('no_polisi');
        $kendaraan->jenis_kendaraan = $request->input('jenis_kendaraan');
        $kendaraan->save();
        return redirect("/kendaraan-admin")->with('success', 'Kendaraan berhasil diperbarui.');
    }

    function delete(Request $request, $id_kendaraan)
    {
        $kendaraan = KendaraanAdminModels::find($id_kendaraan);
        $kendaraan->delete();
        return redirect("/kendaraan-admin")->with('success', 'Kendaraan berhasil dihapus.');
    }
}
