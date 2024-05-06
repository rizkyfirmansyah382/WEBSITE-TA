<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleAdminModels;
use Illuminate\Http\Request;

class RoleAdminControllers extends Controller
{
    function index()
    {
        $role = RoleAdminModels::all();
        return view("admin.role.index", compact('role'));
    }
    function create()
    {
        return view("admin.role.create");
    }

    function createData(Request $request)
    {
        RoleAdminModels::create([
            'role' => $request->input('role')
        ]);
        return redirect('/role-admin')->with('success', 'Role berhasil ditambahkan.');
    }

    public function update($id_role_admin)
    {
        $role = RoleAdminModels::find($id_role_admin);
        return view('admin.role.update', compact('role'));
    }

    public function updateData(Request $request, $id_role_admin)
    {
        $role = RoleAdminModels::find($id_role_admin);
        $role->role = $request->input('role');
        $role->save();
        return redirect("/role-admin")->with('success', 'Role berhasil diperbarui.');
    }

    function delete($id_role_admin, Request $request)
    {
        $role = RoleAdminModels::find($id_role_admin);
        $role->delete();
        return redirect("/role-admin")->with('success', 'Role berhasil dihapus.');
    }
}
