<?php

namespace App\Http\Middleware;

use Closure;

class UserVerify
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
        if( empty( $request->session()->get( 'us3R-un1t3c' ) ) ){

            return redirect( '/' );
        }
        
        return $next($request);
    }
}
