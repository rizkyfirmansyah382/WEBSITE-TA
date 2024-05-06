<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\RoleModels;
use Illuminate\Http\Request;

class RoleSuperAdminControllers extends Controller
{
    function index()
    {
        $role = RoleModels::all();
        return view('superadmin.role.index', compact('role'));
    }

    function create()
    {
        return view('superadmin.role.create');
    }

    function createData(Request $request)
    {
        RoleModels::create([
            'role' => $request->input('role'),
        ]);
        return redirect('role-super-admin')->with('success', 'Role berhasil ditambahkan.');
    }

    public function update($id_role)
    {
        $role = RoleModels::find($id_role);
        return view('superadmin.role.update', compact('role'));
    }

    public function updateData(Request $request, $id_role)
    {
        $role = RoleModels::find($id_role);
        $role->role = $request->input('role');
        $role->save();
        return redirect("/role-super-admin")->with('success', 'Role berhasil diperbarui.');
    }

    function delete($id_role, Request $request)
    {
        $role = RoleModels::find($id_role);
        $role->delete();
        return redirect("/role-super-admin")->with('success', 'Role berhasil dihapus.');
    }
}
