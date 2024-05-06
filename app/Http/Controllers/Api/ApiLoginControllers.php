<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiLoginControllers extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['error' => 'Kredensial tidak valid'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'Berhasil logout'], 200);
    }
}
