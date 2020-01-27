<?php

namespace App\Http\Middleware;

use Closure;

class IsStaff
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
        if(!auth()->user()->isStaff()) {

            return back()->withErrors(['permission_denied' => 'Not allowed to perform action']);

        }
        return $next($request);
    }
}
