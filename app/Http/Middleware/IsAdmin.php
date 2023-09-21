<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // abort_if(!$request->user()->is_admin, 403);
        
        if(!$request->user()->is_admin){
            return redirect()->route('notAuthorized');
        }
        
        return $next($request);   
    }
}
