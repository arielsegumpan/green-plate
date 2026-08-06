<?php

namespace App\Providers\Filament;

use App\Filament\Pages\EditOrganizationProfile;
use App\Filament\Pages\RegisterOrganization;
use App\Filament\Widgets\DateTimeWidget;
use App\Filament\Widgets\GreetingWidget;
use App\Http\Middleware\ApplyOrganizationsScope;
use App\Http\Middleware\Filament\ApplyFilamentTenantThemeMiddleware;
use App\Http\Middleware\PanelRoleMiddleware;
use App\Models\Organization;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filafly\Icons\Phosphor\PhosphorIcons;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsIconAlias;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OrganizationPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('organization')
            ->path('organization')
            ->colors([
                'primary' => Color::Green,
            ])
            ->font('Instrument Sans')
            ->sidebarWidth('15rem')
            ->spa(hasPrefetching: true)
            ->brandLogo(asset('imgs/gp_logo.png', true))
            ->brandLogoHeight('3rem')
            ->favicon(asset('imgs/gp_logo.png'))
            ->topBar(false)
            ->sidebarCollapsibleOnDesktop()
            ->profile()
            ->discoverResources(in: app_path('Filament/Organization/Resources'), for: 'App\Filament\Organization\Resources')
            ->discoverPages(in: app_path('Filament/Organization/Pages'), for: 'App\Filament\Organization\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Organization/Widgets'), for: 'App\Filament\Organization\Widgets')
            ->widgets([
                GreetingWidget::class,
                DateTimeWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ], isPersistent: true)
            ->authGuard('web')
            ->plugins([
                PhosphorIcons::make()
                ->light()
                ->overrideAlias(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM, Phosphor::Speedometer),
            ])
            ->tenant(Organization::class, ownershipRelationship: 'organization', slugAttribute: 'org_slug') // tanan nga tenant
            ->tenantMiddleware([
                ApplyOrganizationsScope::class, // dugang global scope sa tanan nga tenant
                ApplyFilamentTenantThemeMiddleware::class // dugang theme sa tanan nga tenant
            ], isPersistent: true) // persistent para indi mawala ang middleware sa tanan nga routes sa panel
            ->tenantRegistration(RegisterOrganization::class) // custom registration page para sa tanan nga tenant
            ->tenantProfile(EditOrganizationProfile::class) // custom profile page para sa tanan nga tenant
            ->tenantMenuItems([
                'register' => fn (Action $action) => $action->label('New Organization')->icon(Phosphor::Plus)->color('primary'), // custom menu item para sa tanan nga tenant
            ]);
    }
}
