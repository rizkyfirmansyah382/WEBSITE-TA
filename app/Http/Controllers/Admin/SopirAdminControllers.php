<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SopirAdminModels;
use Illuminate\Http\Request;
use Auth;

class SopirAdminControllers extends Controller
{
    function index()
    {
        $AdminId = Auth::user()->id;
        $sopir = SopirAdminModels::where('id_superadmin', $AdminId)
            ->get();
        return view('admin.sopir.index', compact('sopir'));
    }
    function create()
    {
        return view('admin.sopir.create');
    }

    function createData(Request $request)
    {
        $user = Auth::user()->id;

        SopirAdminModels::create([
            'id_superadmin' => $user,
            'nama_sopir' => $request->input('nama_sopir'),

        ]);
        return redirect('/sopir-admin')->with('success', 'Sopir berhasil ditambahkan.');
    }

    public function update($id_sopir)
    {
        $sopir = SopirAdminModels::find($id_sopir);
        return view('admin.sopir.update', compact('sopir'));
    }

    public function updateData(Request $request, $id_sopir)
    {
        $role = SopirAdminModels::find($id_sopir);
        $role->nama_sopir = $request->input('nama_sopir');
        $role->save();
        return redirect("/sopir-admin")->with('success', 'Sopir berhasil diperbarui.');
    }

    function delete($id_sopir, Request $request)
    {
        $sopir = SopirAdminModels::find($id_sopir);
        $sopir->delete();
        return redirect("/sopir-admin")->with('success', 'Sopir berhasil dihapus.');
    }
}
