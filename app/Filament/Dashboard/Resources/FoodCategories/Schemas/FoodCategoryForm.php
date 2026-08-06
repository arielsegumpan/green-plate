<?php

namespace App\Filament\Dashboard\Resources\FoodCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FoodCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('organization_id')
                    ->relationship('organization', 'id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('co2_factor')
                    ->numeric()
                    ->default(null),
                TextInput::make('meal_ratio')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
