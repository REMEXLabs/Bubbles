<?php

namespace App\Http\Middleware;

use Closure;

class IsAnAdmin
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
        $response = $next($request);
        if (!$request->user()->isAnAdmin()) {
            redirect('/');
        }
        return $response;
    }
}
