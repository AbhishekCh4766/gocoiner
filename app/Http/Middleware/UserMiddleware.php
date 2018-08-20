<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
//use App\Http\Middleware\RedirectIfAuthenticated.php

class UserMiddleware
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
        if($request->user() && $request->user()->role != "2"){
            return Redirect('/login');
        }
        return $next($request);
    }

    // public function handle($request, Closure $next, $guard = null)
    //     {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect()->intended('/login');
    //         }

    //         return $next($request);
    //     }
}
