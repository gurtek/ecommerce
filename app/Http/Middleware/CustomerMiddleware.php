<?php

namespace App\Http\Middleware;

use Closure;

class CustomerMiddleware
{
    private $_customer = 'CUS';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $request->user()->type != $this->_customer ) { // auth()->user()->type
            abort(401); // unauthorized
        }
        return $next($request);
    }
}
