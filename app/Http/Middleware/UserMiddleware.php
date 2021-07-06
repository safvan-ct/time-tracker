<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role != 'USR') {
            abort(403);
        }
        return $next($request);
    }
}
