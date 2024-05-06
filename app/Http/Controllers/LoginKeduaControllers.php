<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginKeduaControllers extends Controller
{
    function index()
    {
        return view('logindua');
    }
    public function authLoginDua(Request $request)
    {
        $infoLogin = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::guard('admin')->attempt($infoLogin)) {
            $user = Auth::guard('admin')->user();

            // Periksa peran kelompok
            if ($user->id_role_admin == 1) {
                session([
                    'user' => [
                        'id' => $user->id,
                        'id_role_admin' => $user->id_role_admin,
                        'name' => $user->name,
                    ]
                ]);
                return redirect('/dashboard-kelompok-tani')->with('showSuccessModal', true);
            } elseif ($user->id_role_admin == 2) {
                session([
                    'user' => [
                        'id' => $user->id,
                        'id_role_admin' => $user->id_role_admin,
                        'name' => $user->name,
                    ]
                ]);
                return redirect('/dashboard-mandor')->with('showSuccessModal', true);
            } else {
                Auth::guard('admin')->logout();
                Session::forget('user');
                return redirect('/login-kedua')->withErrors('Anda tidak diizinkan masuk')->withInput();
            }
        } else {
            return redirect('/login-kedua')->withErrors('Email atau Password yang dimasukkan salah')->withInput();
        }
    }

    public function logout(Request $request)
    {
        // Mendapatkan informasi pengguna sebelum logout
        $user = auth()->user();

        // Logout pengguna
        Auth::guard('admin')->logout();

        // Menghapus sesi pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Menyimpan informasi pengguna dalam sesi untuk referensi
        Session::put('user', [
            'id' => $user->id,
            'id_role_admin' => $user->id_role_admin,
            'name' => $user->name,
        ]);

        // Redirect ke halaman login
        return redirect('/login-kedua');
    }

    public function home()
    {
        return redirect('/login-kedua');
    }
}
