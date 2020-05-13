<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    private $_admin = 'ADM';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $request->user()->type != $this->_admin ) { // auth()->user()->type
            abort(401); // unauthorized
        }
        return $next($request);
    }
}
