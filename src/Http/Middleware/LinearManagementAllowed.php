<?php

namespace LaravelLinear\Http\Middleware;

use Closure;
use BadMethodCallException;
use Illuminate\Http\Request;

class LinearManagementAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            abort_unless($request->user()?->allowedToManagerLinearConnection(), 403);
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException("You need to implement the `allowedToManagerLinearConnection` method on you Authenticatable model. Please check the readme file for more information.");
        }

        return $next($request);
    }
}
