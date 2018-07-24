<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        // Ensure that the user is administrator with an enabled account
        if(auth()->user()->admin == 1 && auth()->user()->enabled == 1) {
            return $next($request);
        }

        return redirect('/');
    }
}
