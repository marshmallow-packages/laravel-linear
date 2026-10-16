<?php

namespace LaravelLinear\Http\Middleware;

use BadMethodCallException;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinearManagementAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            abort_unless($request->user()?->allowedToManagerLinearConnection(), 403);
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException('You need to implement the `allowedToManagerLinearConnection` method on you Authenticatable model. Please check the readme file for more information.');
        }

        return $next($request);
    }
}
