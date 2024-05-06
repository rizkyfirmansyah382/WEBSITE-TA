<?php

namespace App\Http\Controllers;

use App\Models\UserSuperAdminModels;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginControllers extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authLogin(Request $request)
    {
        $infoLogin = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::guard('web')->attempt($infoLogin)) {
            $user = Auth::guard('web')->user();
            $userWithRole = UserSuperAdminModels::join('tb_role', 'tb_user_superadmin.id_role', '=', 'tb_role.id_role')
                ->select('tb_user_superadmin.*', 'tb_role.role')
                ->where('tb_user_superadmin.id', $user->id)
                ->first();
            if ($userWithRole) {
                $role = strtolower($userWithRole->role);

                if (strcasecmp($role, 'Super Admin') === 0 || strcasecmp($role, 'super admin') === 0) {
                    session([
                        'user' => [
                            'id' => $userWithRole->id,
                            'id_role' => $userWithRole->id_role,
                            'name' => $userWithRole->name,
                        ]
                    ]);
                    return redirect('/dashboard-super-admin')->with('showSuccessModal', true);
                } elseif (strcasecmp($role, 'Unit Usaha Otonom') === 0 || strcasecmp($role, 'unit usaha otonom') === 0) {
                    session([
                        'user' => [
                            'id' => $userWithRole->id,
                            'id_role' => $userWithRole->id_role,
                            'name' => $userWithRole->name,
                        ]
                    ]);
                    return redirect('/dashboard-admin')->with('showSuccessModal', true);
                } else {
                    Auth::guard('web')->logout();
                    Session::forget('user');
                    return redirect('/login')->withErrors('Anda tidak diizinkan masuk')->withInput();
                }
            }
        }

        return redirect('/login')->withErrors('Username atau Password yang dimasukkan salah')->withInput();
    }

    public function logout(Request $request)
    {
        // Mendapatkan informasi pengguna sebelum logout
        $user = auth()->user();

        // Logout pengguna
        Auth::guard('web')->logout();

        // Menghapus sesi pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Menyimpan informasi pengguna dalam sesi untuk referensi
        Session::put('user', [
            'id' => $user->id,
            'id_role' => $user->id_role,
            'name' => $user->name,
        ]);

        // Redirect ke halaman login
        return redirect('/login');
    }

    public function home()
    {
        return redirect('/login');
    }
}
