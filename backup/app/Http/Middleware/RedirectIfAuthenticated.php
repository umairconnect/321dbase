<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  $guard
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($guard == 'masterAdmin') {
                return redirect()->route('masteradmin.dashboard');
            } else if ($guard == 'groupAdmin') {
                return redirect()->route('groupadmin.dashboard');
            } else if ($guard == 'operator') {
                return redirect()->route('operator.main');
            }
            
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
