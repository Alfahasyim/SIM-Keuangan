<?php

namespace App\Http\Middleware;

use Closure,Auth;

class KeuanganMiddleware
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
        if ($user->level == "keuangan") {
          return $next($request);
        }
        abort(404);
    }
}
