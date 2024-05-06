<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $allowedRole)
    {
        // Menggunakan guard 'admin'
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();

            if ($user && $this->checkUserAllowed($user->id_role_admin, $allowedRole)) {
                return $next($request);
            }
        }

        Auth::guard('admin')->logout();

        return redirect('/login-kedua')->with('error', 'Unauthorized. Please log in with valid credentials.');
    }

    /**
     * Check if the user is allowed based on their role.
     *
     * @param  int  $userRole
     * @param  string|array  $allowedRole
     * @return bool
     */
    private function checkUserAllowed($userRole, $allowedRole)
    {
        if (is_array($allowedRole)) {
            return in_array($userRole, $allowedRole);
        }

        return $userRole == $allowedRole;
    }
}
