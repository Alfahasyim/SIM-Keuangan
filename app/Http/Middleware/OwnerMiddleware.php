<?php

namespace App\Http\Middleware;

use Closure,Auth;

class OwnerMiddleware
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
        $user = Auth::user();
        if ($user->level == "owner") {
          return $next($request);
        }
        abort(404);
    }
}
