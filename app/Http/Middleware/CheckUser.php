<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $allowedRole
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $allowedRole)
    {
        $user = Auth::user();

        if ($user && $this->checkUserAllowed($user->id_role, $allowedRole)) {
            return $next($request);
        }

        Auth::logout();

        return redirect('/login')->with('error', 'Unauthorized. Please log in with valid credentials.');
    }

    /**
     * Check if the user is allowed based on their group.
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
