<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Require that the user is logged in and an admin
        if (!Auth::user()){
            return redirect('login')->with('danger', 'You must be logged in to access that page.');
        }
        if (!Auth::user()->isAdmin()){
            return redirect('resources')->with('danger', 'You do not have permission to access that page.');
        }
        return $next($request);
    }
}
