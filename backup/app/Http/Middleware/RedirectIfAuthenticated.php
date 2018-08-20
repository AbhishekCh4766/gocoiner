<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)

    {

        //die($request);
/*  if (Auth::guard($guard)->check()) {
     //   print_r($guard); die;
            return redirect()->route('admin.index');
        }*/

         if (Auth::check()) {
             
            // dd(Auth::user());
             return redirect()->route('admin.index');
        }
       /* if (Auth::check() && Auth::user()->role == 2) {
     //   print_r($guard); die;
            return response('template');
        }*/

       return $next($request);
    }
}
