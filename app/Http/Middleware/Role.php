<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Auth\Factory as Auth;
// use Illuminate\Auth\Middleware\Authorize as Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // sek sek masi eror
        // yang \Auth di modul tuh apa ya? 
        // kalo pake auth/factory as auth, gada method user
        // kalo pake facades/auth as auth, gada method can
        // if (Auth::user()->can($role . '-access'))
        // // middleware('can:$role . '-access))
        // {
        //     return $next($request);
        // }
        // return response('Unauthorized.', 401);
    }
}
