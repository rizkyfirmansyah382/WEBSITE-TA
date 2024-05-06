<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\RoleModels;
use App\Models\UserSuperAdminModels;
use Illuminate\Http\Request;

class UserSuperAdminControllers extends Controller
{
    function index()
    {
        $user = UserSuperAdminModels::select('tb_user_superadmin.*', 'tb_role.role')
            ->join('tb_role', 'tb_user_superadmin.id_role', '=', 'tb_role.id_role')
            ->where('tb_role.id_role', 2)
            ->orderBy('tb_user_superadmin.id', 'desc')
            ->get();
        return view('superadmin.pengguna.index', compact('user'));
    }

    function create()
    {
        $role = RoleModels::all();
        return view('superadmin.pengguna.create', compact('role'));
    }
    function createData(Request $request)
    {
        $hash = bcrypt($request->input('password'));
        UserSuperAdminModels::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'id_role' => $request->input('id_role'),
            'password' => $hash,
        ]);
        return redirect('/user-super-admin')->with('success', 'User berhasil ditambahkan.');
    }
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $userId = $request->input('userId'); // Sertakan ID pengguna yang sedang diupdate

        $isUnique = UserSuperAdminModels::where('username', $username)
            ->where('id', '!=', $userId) // Hindari memeriksa keunikan username untuk pengguna dengan ID yang sedang diupdate
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }


    public function update($id)
    {
        $user = UserSuperAdminModels::find($id);
        $role = RoleModels::all();
        return view('superadmin.pengguna.update', compact('user', 'role'));
    }

    public function updateData(Request $request, $id)
    {
        try {
            $hash = bcrypt($request->input('password'));

            $user = UserSuperAdminModels::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }

            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->password = $hash;
            $user->id_role = $request->input('id_role');

            $user->save();
            return redirect("/user-super-admin")->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui user. Pesan Kesalahan: ' . $e->getMessage());
        }
    }


    function delete($id, Request $request)
    {
        $user = UserSuperAdminModels::find($id);
        $user->delete();
        return redirect("/user-super-admin")->with('success', 'User berhasil dihapus.');
    }
}
