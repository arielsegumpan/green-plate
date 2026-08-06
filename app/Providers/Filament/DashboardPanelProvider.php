<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\GreetingWidget;
use App\Http\Middleware\PanelRoleMiddleware;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filafly\Icons\Phosphor\PhosphorIcons;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsIconAlias;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('dashboard')
            ->path('dashboard')
            ->colors([
                'primary' => Color::Green,
            ])
            ->font('Montserrat')
            ->sidebarWidth('15rem')
            ->spa(hasPrefetching: true)
            ->brandLogo(asset('imgs/gp_logo.png', true))
            ->brandLogoHeight('3rem')
            ->favicon(asset('imgs/gp_logo.png'))
            ->topBar(false)
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Dashboard/Resources'), for: 'App\Filament\Dashboard\Resources')
            ->discoverPages(in: app_path('Filament/Dashboard/Pages'), for: 'App\Filament\Dashboard\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Dashboard/Widgets'), for: 'App\Filament\Dashboard\Widgets')
            ->widgets([
                GreetingWidget::class,
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                PanelRoleMiddleware::class
            ])
            ->plugins([
                
                FilamentShieldPlugin::make()
                    ->navigationLabel('Roles')
                    ->activeNavigationIcon('heroicon-s-shield-check')
                    ->navigationGroup('User Mgmt')
                    ->navigationSort(20)
                    ->navigationBadgeColor('success'),

                PhosphorIcons::make()
                    ->light()
                    ->overrideAlias(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM, Phosphor::Speedometer),
            ])
            ->authMiddleware([
                Authenticate::class,
            ], isPersistent: true)
            ->authGuard('web');
    }
}
