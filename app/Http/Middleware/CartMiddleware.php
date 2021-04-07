<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartMiddleware
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
        $qty = $request->route()->parameters()['qty'];
        if(!is_numeric($qty)) {
            return response('Invalid request', 400);
        }
        return $next($request);
    }
}
