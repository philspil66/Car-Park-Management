<?php

namespace App\Http\Middleware;

use Closure;

class Impersonate
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
            if($request->session()->has('impersonate'))
            {
                $oldUserFullname = '';
                if ( \Auth::user() ) {
                    $oldUserFullname = \Auth::user()->getFullname();
                }
                
                \Auth::onceUsingId($request->session()->get('impersonate'));
                
                if ( \Auth::user() ) {
                    \Log::info('Middlweare: '.$oldUserFullname. ' is now impersonating '.\Auth::user()->getFullname());
                }

            } 

        return $next($request);
    }
}

