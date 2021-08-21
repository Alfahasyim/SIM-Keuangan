<?php

namespace App\Http\Middleware;

use Closure,Auth;

class AdminMiddleware
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
        if ($user->level == "admin") {
          return $next($request);
        }
        abort(404);
    }
}
