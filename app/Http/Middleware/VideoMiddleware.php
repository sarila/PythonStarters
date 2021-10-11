<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VideoMiddleware
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
       if(!Auth::guard('admin')->check() && !Auth::user()){
            return redirect('/user/login');
        }
        return $next($request);
    }
}
