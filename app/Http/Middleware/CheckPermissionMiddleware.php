<?php

namespace App\Http\Middleware;

use Closure;
class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\e  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = $request->route()->getAction();
        return haspermission(strtolower($action['controller'])) ? $next($request) : repJson('','Permission denied',500);
    }
}
