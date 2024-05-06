<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelompokAdminModels;
use Illuminate\Http\Request;
use Auth;

class KelompokAdminControllers extends Controller
{
    function index()
    {
        $AdminId = Auth::user()->id;
        $kelompok = KelompokAdminModels::where('id_superadmin', $AdminId)
            ->get();
        return view('admin.kelompok.index', compact('kelompok'));
    }

    function create()
    {
        return view('admin.kelompok.create');
    }

    function createData(Request $request)
    {
        $AdminId = Auth::user()->id;

        KelompokAdminModels::create([
            'id_superadmin' => $AdminId,
            'nama_kelompok' => $request->input('nama_kelompok'),
        ]);
        return redirect('/kelompok-admin')->with('success', 'Kelompok berhasil ditambahkan.');
    }

    function update($id_kelompok)
    {
        $kelompok = KelompokAdminModels::find($id_kelompok);
        return view('admin.kelompok.update', compact('kelompok'));
    }

    function updateData(Request $request, $id_kelompok)
    {
        $kelompok = KelompokAdminModels::find($id_kelompok);
        $kelompok->nama_kelompok = $request->input('nama_kelompok');
        $kelompok->save();
        return redirect("/kelompok-admin")->with('success', 'Kelompok berhasil diperbarui.');
    }
    function delete(Request $request, $id_kelompok)
    {
        $kelompok = KelompokAdminModels::find($id_kelompok);
        $kelompok->delete();
        return redirect("/kelompok-admin")->with('success', 'Kelompok berhasil dihapus.');
    }
}