<?php

namespace App\Http\Middleware;

use Closure;

class ServiceMiddleware
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
        if (!$request->header('service-key') || $request->header('service-key') !== env('SERVICE_APP_KEY')) {
            return abort(403);
        }

        return $next($request);    }
}
