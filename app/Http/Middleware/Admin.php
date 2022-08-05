<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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

        if ( Auth::check() && Auth::user()->role->lang->name == _ROLE_ADMIN_TEXT_ )
        {
            return $next($request);
        }

        return redirect()->guest('login');

    }
}
