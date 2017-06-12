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
        //Require that the user is an admin
        if (!Auth::user()->isAdmin()){
            abort(404);
            //return redirect('resources')->with('danger', 'You do not have permission to access that page.');
        }
        return $next($request);
    }
}
