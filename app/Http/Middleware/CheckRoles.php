<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckRoles
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
       $roles=array_slice(func_get_args(), 2);
       foreach ($roles as $rol) {
           if (Auth::user()->rol==$rol) {
             return $next($request);
           }
       }

        return redirect('/home');
    }
}
