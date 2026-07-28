<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401);
        }

        // Check Spatie role
        if (! $user->hasRole('driver')) {
            abort(403, 'Only drivers may access this resource.');
        }

        // Get organization from route model binding
        $organization = $request->route('organization');

        if ($organization) {
            $belongs = $user->organizations()
                ->whereKey($organization->id)
                ->exists();

            if (! $belongs) {
                abort(403, 'You do not belong to this organization.');
            }
        }

        return $next($request);
    }
}
