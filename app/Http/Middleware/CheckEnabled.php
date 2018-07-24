<?php

namespace App\Http\Middleware;

use Closure;

class CheckEnabled
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
        // Ensure that the user is enabled
        if(auth()->user()->enabled == 1) {
            return $next($request);
        }

        return redirect('/');
    }
}
