<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        
        if(Auth::check()) {
            if(Auth::user()->role_name == 'admin') {
                return $next($request);
            }
            else {
                return back();
            }
        }
        return $next($request);


    }
}
