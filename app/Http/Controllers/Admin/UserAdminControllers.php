<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleAdminModels;
use App\Models\UserAdminModels;
use Illuminate\Http\Request;
use Auth;

class UserAdminControllers extends Controller
{
    public function index()
    {
        // Mendapatkan id user yang sedang login
        $userId = Auth::user()->id;

        // Mengambil data user-admin berdasarkan id_superadmin yang sesuai
        $user = UserAdminModels::select('tb_user_admin.*', 'tb_role_admin.role')
            ->join('tb_role_admin', 'tb_user_admin.id_role_admin', '=', 'tb_role_admin.id_role_admin')
            ->where('id_superadmin', $userId)
            ->get();

        return view("admin.pengguna.index", compact('user'));
    }

    function create()
    {
        $role = RoleAdminModels::all();
        return view("admin.pengguna.create", compact('role'));
    }

    function createData(Request $request)
    {
        $hash = bcrypt($request->input('password'));
        $user = Auth::user()->id;


        UserAdminModels::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'id_superadmin' => $user,
            'id_role_admin' => $request->input('role'),
            'password' => $hash,
        ]);
        return redirect('/user-admin')->with('success', 'User berhasil ditambahkan.');
    }

    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $userId = $request->input('userId');

        $isUnique = UserAdminModels::where('username', $username)
            ->where('id', '!=', $userId) // Hindari memeriksa keunikan username untuk pengguna dengan ID yang sedang diupdate
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }


    public function update($id)
    {
        $user = UserAdminModels::find($id);
        $role = RoleAdminModels::all();
        return view('admin.pengguna.update', compact('user', 'role'));
    }

    public function updateData(Request $request, $id)
    {
        try {
            $hash = bcrypt($request->input('password'));

            $user = UserAdminModels::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }

            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->password = $hash;
            $user->id_role_admin = $request->input('role');

            $user->save();
            return redirect("/user-admin")->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui user. Pesan Kesalahan: ' . $e->getMessage());
        }
    }


    function delete($id, Request $request)
    {
        $user = UserAdminModels::find($id);
        $user->delete();
        return redirect("/user-admin")->with('success', 'User berhasil dihapus.');
    }
}
