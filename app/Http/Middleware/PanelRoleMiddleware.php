<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $currentPanel = Filament::getCurrentPanel();
        $currentPanelId = $currentPanel?->getId();

        // Reset team context up front — only tenant-aware panels should set it
        if (!$currentPanel?->hasTenancy()) {
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId(null);
        }

        // If no user, redirect to login
        if (!$user) {
            return redirect()->route('filament.auth.auth.login');
        }

        if (!$currentPanelId) {
            return $this->redirectToUserPanel($user);
        }

        // Redirect authenticated users away from auth panel
        if ($currentPanelId === 'auth') {
            return $this->redirectToUserPanel($user);
        }

        // Panel → allowed roles mapping
        $panelRoles = [
            'dashboard' => ['super_admin'],
            'organization' => ['donor', 'recipient', 'both', 'super_admin'],
            'driver' => ['driver', 'super_admin'],
            'auth' => [],
        ];

        $requiredRoles = $panelRoles[$currentPanelId] ?? [];

        // Check if user has required role for current panel
        if (!empty($requiredRoles) && $user->hasAnyRole($requiredRoles)) {
            return $next($request);
        }

        // User doesn't have access - redirect based on their role
        return $this->redirectToUserPanel($user);
    }

    /**
     * Redirect user to their appropriate panel based on role
     */
    protected function redirectToUserPanel($user): Response
    {
        // Super admin → dashboard
        if ($user->hasRole('super_admin')) {
            return redirect()->to(Filament::getPanel('dashboard')->getUrl());
        }
        // Tenant -> organization
        if ($user->hasAnyRole(['donor', 'recipient', 'both'])) {
            $defOrganization = $user->organizations()->first();
            if ($defOrganization) {
                return redirect()->to(
                    Filament::getPanel('organization')->getUrl($defOrganization)
                );
            }

            // If shop owner has no shops, redirect to tenant registration
            return redirect()->route('filament.organization.tenant.registration');
        }

        // Guest role → homepage
        if ($user->hasRole('guest')) {
            return redirect()->to('/');
        }

        // No recognized role or no role at all → login
         auth()->logout(); // Log the user out halin sa gwa kag panel
        return redirect()->route('filament.auth.auth.login');
    }


}
