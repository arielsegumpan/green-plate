<?php

namespace App\Filament\Pages;

use App\Models\Organization;
use App\Models\Tenant;
use Fahiem\FilamentPinpoint\Pinpoint;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class RegisterOrganization extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register your organization';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Wizard::make([
                    Step::make('Shop Details')
                        ->description('Provide your shop information to get started.')
                        ->icon(Phosphor::Storefront)
                        ->completedIcon(Phosphor::CheckCircle)
                        ->schema([
                            Group::make([
                                FileUpload::make('shop_logo')
                                    ->label('Shop Logo')
                                    ->required()
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('shop_uploads')
                                    ->visibility('public')
                                    ->columnSpan([
                                        'default' => 1,
                                        'md' => 2,
                                        'lg' => 2,
                                    ]),

                                Group::make([
                                    TextInput::make('shop_name')
                                        ->required()
                                        ->trim()
                                        ->maxLength(255)
                                        ->scopedUnique()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('shop_slug', Str::slug($state))),
                                    TextInput::make('shop_slug')
                                        ->required()
                                        ->trim()
                                        ->maxLength(255)
                                        ->disabled()
                                        ->dehydrated()
                                        ->scopedUnique(),

                                    TextInput::make('shop_email')
                                        ->email()
                                        ->trim()
                                        ->required()
                                        ->suffixIcon(Heroicon::Envelope)
                                        ->maxLength(255)
                                        ->columnSpanFull(),

                                    TextInput::make('shop_phone')
                                        ->tel()
                                        ->trim()
                                        ->required()
                                        ->suffixIcon(Heroicon::Phone)
                                        ->maxLength(255)
                                        ->columnSpanFull(),

                                ])
                                    ->columns(2)
                                    ->columnSpan([
                                        'default' => 1,
                                        'md' => 3,
                                        'lg' => 3,
                                    ])
                            ])
                                ->columnSpanFull()
                                ->columns([
                                    'default' => 1,
                                    'md' => 5,
                                    'lg' => 5,
                                ]),
                        ]),
                    Step::make('Select Location')
                        ->description('Select your shop location.')
                        ->icon(Phosphor::MapPin)
                        ->completedIcon(Phosphor::CheckCircle)
                        ->schema([
                            Group::make([
                                Pinpoint::make('shop_address')
                                    ->label('Location')
                                    ->provider('leaflet')
                                    ->defaultLocation(10.90154, 123.0705) // Jakarta
                                    ->defaultZoom(15)
                                    ->height(400)
                                    ->latField('shop_latitude')
                                    ->lngField('shop_longitude')
                                    ->addressField('shop_address')
                                    ->draggable()
                                    ->searchable()
                                    ->columnSpanFull()
                                    ->height(300)
                                    ->dehydrated(),

                                TextInput::make('shop_latitude')
                                    ->label('Latitude')
                                    ->readOnly(),

                                TextInput::make('shop_longitude')
                                    ->label('Longitude')
                                    ->readOnly(),
                            ])
                                ->columnSpanFull()
                                ->columns([
                                    'default' => 1,
                                    'md' => 2,
                                    'lg' => 2,
                                ])
                        ]),


                ])
                    ->submitAction(new HtmlString(Blade::render(<<<'BLADE'
                        <x-filament::button type="submit" size="sm">
                            Register Shop
                        </x-filament::button>
                    BLADE)))

            ]);
    }

    /**
     * Remove the default register button rendered outside the wizard.
     */
    protected function getFormActions(): array
    {
        return [];
    }


    protected function handleRegistration(array $data): Tenant
    {

        $data['status'] = 'active';

        $org = Organization::create($data);
        $org->users()->attach(Auth::user());
        $this->orgNotif();
        return $org;
    }

    // protected function generateShopId(): string
    // {
    //     return Str::upper('BLKIT' . '-' . Str::random(6));
    // }

    protected function orgNotif(): void
    {
        Notification::make()
            ->title('Organization registered')
            ->body("
                Organization successfully registered. Please wait for approval.
            ")
            ->success()
            ->seconds(30)
            ->send();
    }

    public function getMaxContentWidth(): Width
    {
        return Width::SixExtraLarge;
    }
}
