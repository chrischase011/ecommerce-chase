<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Shetabit\Visitor\Traits\Visitable;
class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        visitor()->visit();
        return $next($request);
    }
}
