<?php

namespace App\Filament\Organization\Resources\Donations\Schemas;

use Fahiem\FilamentPinpoint\PinpointEntry;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DonationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make()
                    ->schema([
                        TextEntry::make('reference_no')
                            ->icon(Phosphor::Receipt)
                            ->placeholder('-')
                            ->label('REF #')
                            ->size('lg')
                            ->weight('bold')
                            ->color('success'),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn ($state) => $state->getColor())
                            ->icon(fn ($state) => $state->getIcon())
                            ->formatStateUsing(fn ($state) => $state->getLabel()),

                        TextEntry::make('available_from')
                            ->dateTime('M j, Y h:i A')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('expires_at')
                            ->dateTime('M j, Y h:i A')
                            ->badge()
                            ->color('danger'),
                    ])
                    ->columns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 4,
                    ])
                    ->columnSpanFull(),
                // ->columnSpan([
                //     'default' => 1,
                //     'sm' => 1,
                //     'md' => 2,
                //     'lg' => 2,
                // ]),

                RepeatableEntry::make('donationItems')
                    ->hiddenLabel()
                    ->schema([

                        TextEntry::make('food_name')
                            ->label('Name')
                            ->weight('bold')
                            ->size('lg'),

                        TextEntry::make('foodCategory.name')
                            ->label('Category')
                            ->placeholder('-')
                            ->formatStateUsing(fn ($state) => Str::title($state)),

                        TextEntry::make('quantity')
                            ->label('Qty.')
                            ->placeholder('-')
                            ->numeric(),

                        TextEntry::make('unit')
                            ->label('Unit')
                            ->placeholder('-')
                            ->formatStateUsing(fn ($state) => Str::title($state)),

                        TextEntry::make('temperature_required')
                            ->label('Temperature')
                            ->placeholder('-')
                            ->formatStateUsing(fn ($state) => Str::title($state)),

                         TextEntry::make('estimated_meals')
                            ->label('Meals')
                            ->placeholder('-')
                            ->formatStateUsing(fn ($state) => Str::title($state)),
                        
                        TextEntry::make('food_desc')
                            ->label('Description')
                            ->placeholder('-')
                            ->columnSpanFull()
                            ->formatStateUsing(fn ($state) => Str::words($state)),

                        ImageEntry::make('food_imgs.images')
                            ->label('Attachments')
                            ->placeholder('-')
                            ->disk('public')
                            ->visibility('public')
                            ->stacked()
                            ->imageHeight(120)
                            ->ring(10)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 3,
                        'lg' => 3,
                    ])
                    ->columnSpan([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 3,
                        'lg' => 3,
                    ]),
                Section::make()
                    ->schema([
                        TextEntry::make('pickup_location.address')
                            ->label('Address')
                            ->icon(Phosphor::MapPin)
                            ->iconColor('success')
                            ->wrap()
                            ->weight('bold'),

                        PinpointEntry::make('pickup_location')
                            ->label('Pick up Location')
                            ->latField('pickup_location.lat')
                            ->lngField('pickup_location.lng')
                            ->defaultZoom(17)
                            ->height(250),
                    ])
                    ->columnSpan([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ]),
            ])
            ->columns([
                'default' => 1,
                'sm' => 1,
                'md' => 5,
                'lg' => 5,
            ]);
    }
}
