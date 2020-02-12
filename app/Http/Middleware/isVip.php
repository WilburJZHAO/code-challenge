<?php

namespace App\Http\Middleware;

use Closure;

class isVip
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
        if (auth()->user()->role === 'vip') {
            return $next($request);
        }
        return redirect('/home');
    }
}
