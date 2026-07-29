<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Registration;
use App\Http\Middleware\PanelRoleMiddleware;
use Caresome\FilamentAuthDesigner\AuthDesignerPlugin;
use Caresome\FilamentAuthDesigner\Enums\MediaPosition;
use Caresome\FilamentAuthDesigner\View\AuthDesignerRenderHook;
use Filafly\Icons\Phosphor\PhosphorIcons;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AuthPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('auth')
            ->path('auth')
            ->login()
            ->registration()
            ->colors([
                'primary' => Color::Green,
            ])
            ->font('Montserrat')
            ->spa(hasPrefetching: true)
            ->brandLogo(asset('imgs/gp_logo.png', true))
            ->brandLogoHeight('7rem')
            ->favicon(asset('imgs/gp_logo.png'))
            ->topBar(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
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
            ])
            ->authMiddleware([
                Authenticate::class,
                PanelRoleMiddleware::class
            ], isPersistent: true)
            ->authGuard('web')
            ->plugins([
                AuthDesignerPlugin::make()
                ->defaults(fn ($config) => $config
                    ->media(asset('imgs/hero_img2.jpg'))
                    ->mediaPosition(MediaPosition::Right)
                    ->mediaSize('40%')
                )
                ->login(fn ($config) => $config
                    ->media(asset('imgs/hero_img2.jpg'))
                    ->mediaPosition(MediaPosition::Right)
                    ->mediaSize('40%')
                    ->themeToggle(bottom: '2rem', left: '2rem')
                    ->renderHook(AuthDesignerRenderHook::CardBefore, fn () => view('auth.media-overlay'))
                )
                ->registration(fn ($config) => $config
                    ->media(asset('imgs/hero_img2.jpg'))
                    ->mediaPosition(MediaPosition::Right)
                    ->mediaSize('40%')
                    ->themeToggle(bottom: '2rem', left: '2rem')
                    ->usingPage(Registration::class))


                ->passwordReset(fn ($config) => $config
                    ->mediaPosition(MediaPosition::Right)
                    ->mediaSize('40%')
                )
                ->themeToggle(),

                PhosphorIcons::make()->light()
            ]);
    }
}
