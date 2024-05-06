<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlokAdminModels;
use Illuminate\Http\Request;
use Auth;

class BlokAdminControllers extends Controller
{
    function index()
    {
        $AdminId = Auth::user()->id;
        $blok = BlokAdminModels::where('id_superadmin', $AdminId)
            ->get();
        return view('admin.blok.index', compact('blok'));
    }

    function create()
    {
        return view('admin.blok.create');
    }

    function createData(Request $request)
    {
        $AdminId = Auth::user()->id;

        BlokAdminModels::create([
            'id_superadmin' => $AdminId,
            'blok' => $request->input('blok'),
        ]);
        return redirect('/blok-admin')->with('success', 'Data Berhasil Disimpan');
    }

    function update($id_blok)
    {
        $blok = BlokAdminModels::find($id_blok);
        return view('admin.blok.update', compact('blok'));
    }

    function updateData(Request $request, $id_blok)
    {
        $blok = BlokAdminModels::find($id_blok);
        $blok->blok = $request->input('blok');
        $blok->save();
        return redirect("/blok-admin")->with('success', 'Blok berhasil diperbarui.');
    }

    function delete(Request $request, $id_blok)
    {
        $blok = BlokAdminModels::find($id_blok);
        $blok->delete();
        return redirect("/blok-admin")->with('success', 'Blok berhasil dihapus.');
    }
}
