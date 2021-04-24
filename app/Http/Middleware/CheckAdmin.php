<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class CheckAdmin
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

        if(Auth::check())
        {
            if(Auth::user()->usercontrol == 1)
            {
               return $next($request); 
            }
        }
       
            return redirect('/')->with('error', 'Error 404: Page not found.');
        
        
    }
}
