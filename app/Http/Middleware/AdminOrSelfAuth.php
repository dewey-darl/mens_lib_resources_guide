<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOrSelfAuth
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
        $user = $request->route('user');
        //If the user isn't an admin AND the user they're trying to see/alter/delete isn't them
        if (Auth::user()->isAdmin() || $user == Auth::user()){
            return $next($request);
        }
        return back()->with('danger', 'You don\'t have permission to do that');
    }
}
