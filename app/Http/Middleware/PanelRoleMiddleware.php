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
            'organization' => ['organization', 'super_admin'],
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
        if ($user->hasRole('organization')) {
            $defaultNetShop = $user->organizations()->first();
            if ($defaultNetShop) {
                return redirect()->to(
                    Filament::getPanel('organization')->getUrl($defaultNetShop)
                );
            }

            // If shop owner has no shops, redirect to tenant registration
            return redirect()->route('filament.myshop.tenant.registration');
        }

        if( $user->hasRole('mechanic')) {
            return redirect()->to(Filament::getPanel('mechanic')->getUrl());
        }

        // Guest role → homepage
        if ($user->hasRole('guest')) {
            return redirect()->to('/');
        }

        // No recognized role or no role at all → login
        return redirect()->route('filament.auth.auth.login');
    }


}
