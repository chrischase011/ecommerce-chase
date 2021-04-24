<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class ForbiddenEntry
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
        if(!Auth::check())
        {
            return redirect('/signin-signup')->with('notSign', 'Please <strong>Sign in</strong> first to access more features.');
        }
        return $next($request);
    }
}
