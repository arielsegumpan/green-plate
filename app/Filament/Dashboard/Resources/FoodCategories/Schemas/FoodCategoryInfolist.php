<?php

namespace App\Filament\Dashboard\Resources\FoodCategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FoodCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('organization.id')
                    ->label('Organization'),
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
            ]);
    }
}
