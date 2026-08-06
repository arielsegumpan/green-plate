<?php

namespace App\Filament\Organization\Resources\FoodCategories\Schemas;

use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FoodCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->icon(Phosphor::Bread)
                    ->description('Manage your food categories.')
                    ->aside()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('co2_factor')
                            ->numeric()
                            ->default(null),
                        TextInput::make('meal_ratio')
                            ->numeric()
                            ->default(null),
                    ])
                    ->columnSpanFull()
            ]);
    }
}
