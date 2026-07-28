<?php

namespace App\Http\Middleware\Filament;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyFilamentTenantThemeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $organization = filament()->getTenant();

        if (!$organization) {
            return $next($request);
        }

        Filament::getCurrentPanel()->brandLogo($organization->getBrandLogo());
        Filament::getCurrentPanel()->brandLogoHeight('3rem');

        return $next($request);
    }
}
