<?php

namespace App\Http\Middleware;

use Closure;

class ApiAcceptJson
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
        if ($request->hasHeader('Accept') && $request->header('Accept') === 'application/json') {
            return $next($request);
        }

        return response('Forbidden', 403);
    }
}
