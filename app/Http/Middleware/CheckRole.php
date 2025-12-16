<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Ensure user is authenticated first
        if (! $request->user()) {
            abort(403, 'Unauthorized');
        }

        // If no role provided, deny (or you can allow)
        if ($role === null) {
            abort(403, 'Role not specified');
        }

        // Check role
        if ($request->user()->role !== $role) {
            abort(403, 'Unauthorized, this aint for you!');
        }

        return $next($request);
    }
}
