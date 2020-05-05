<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use NunoMaduro\Collision\Provider;

class EmployeeMiddleware
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

        var_dump(Auth::user());

        return $next($request);

    }
}
