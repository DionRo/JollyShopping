<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NoAdminRedirect
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
        if (Auth::check() == true) {
            if (Auth::user()->userLevel <= 0) {
                return redirect()->action('pagesController@index');
            }

        } else {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
