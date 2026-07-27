<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyOrganizationsScope
{
    /**
     * Models that should be automatically scoped to the current tenant.
     *
     * @var array<class-string>
     */
    protected array $tenantScopedModels = [

    ];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($tenant = Filament::getTenant()) {
            foreach ($this->tenantScopedModels as $model) {
                $model::addGlobalScope(
                    'organization',
                    fn (Builder $query) => $query->whereBelongsTo($tenant),
                );
            }
        }

        return $next($request);
    }
}
