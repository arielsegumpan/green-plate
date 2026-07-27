<?php

namespace App\Filament\Pages;

use Fahiem\FilamentPinpoint\Pinpoint;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditOrganizationProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Organization profile';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    Section::make('Shop Information')
                        ->description('Update your shop information below.')
                        ->icon(Phosphor::Storefront)
                        ->schema([
                            Group::make([

                                FileUpload::make('shop_logo')
                                    ->label('Logo')
                                    ->required()
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('shop_uploads')
                                    ->visibility('public')
                                    ->maxSize(512)
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
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('shop_slug', Str::slug($state)))
                                        ->columnSpanFull(),
                                    TextInput::make('shop_slug')
                                        ->label('Slug')
                                        ->required()
                                        ->trim()
                                        ->maxLength(255)
                                        ->disabled()
                                        ->dehydrated()
                                        ->scopedUnique()
                                        ->helperText('Warning: Changing the slug will redirect you to the new URL.')
                                        ->alphaDash()
                                        ->columnSpanFull(),

                                    TextInput::make('shop_email')
                                        ->label('Email')
                                        ->email()
                                        ->trim()
                                        ->required()
                                        ->prefixIcon(Phosphor::Envelope)
                                        ->columnSpanFull(),
                                    TextInput::make('shop_phone')
                                        ->label('Phone')
                                        ->tel()
                                        ->trim()
                                        ->required()
                                        ->prefixIcon(Phosphor::Phone)
                                        ->columnSpanFull(),


                                ])
                                    ->columns(2)
                                    ->columnSpan([
                                        'default' => 1,
                                        'md' => 3,
                                        'lg' => 3,
                                    ]),
                            ])
                                ->columns([
                                    'default' => 1,
                                    'md' => 5,
                                    'lg' => 5,
                                ]),
                        ])
                ])
                    ->columnSpan([
                        'default' => 1,
                        'md' => 3,
                        'lg' => 3,
                    ]),

                Group::make([
                    Section::make('Address & Location')
                        ->icon(Phosphor::MapPin)
                        ->description('Update your shop address and location below.')
                        ->schema([
                            Pinpoint::make('shop_address')
                                ->label('Location')
                                ->provider('leaflet')
                                ->defaultZoom(15)
                                ->height(400)
                                ->latField('shop_latitude')
                                ->lngField('shop_longitude')
                                ->addressField('address')
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
                        ->columns([
                            'default' => 1,
                            'md' => 2,
                            'lg' => 2,
                        ])
                ])
                    ->columnSpan([
                        'default' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ])
            ])
            ->columns([
                'default' => 1,
                'md' => 5,
                'lg' => 5,
            ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldSlug = $record->org_slug;
        $newSlug = $data['org_slug'];

        $record->update($data);

        // If slug changed, redirect to the new tenant URL
        if ($oldSlug !== $newSlug) {
            $this->redirect(
                route('filament.myshop.tenant', ['tenant' => $newSlug]),
                navigate: false
            );
        }

        return $record;
    }
}
