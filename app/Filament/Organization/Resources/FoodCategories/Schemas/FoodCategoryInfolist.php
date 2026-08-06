<?php

namespace App\Filament\Organization\Resources\FoodCategories\Schemas;

use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FoodCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('')
                    ->icon(Phosphor::Bread)
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('co2_factor')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('meal_ratio')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'lg' => 2
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
