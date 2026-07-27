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
        $tenant = filament()->getTenant();
         
        if (!$tenant) {
            return $next($request);
        }

        Filament::getCurrentPanel()->brandLogo($tenant->getBrandLogo());
        Filament::getCurrentPanel()->brandLogoHeight('3.5rem');

        return $next($request);
    }
}
