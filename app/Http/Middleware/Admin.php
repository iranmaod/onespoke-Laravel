<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if (!auth()->user()) {
            dd('sds');
            return redirect('/');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect('/');
        }

        return $next($request);
    }
}
