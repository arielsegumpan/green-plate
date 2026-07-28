<?php

namespace App\Filament\Dashboard\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('organization_id')
                    ->relationship('organization', 'id')
                    ->required(),
                TextInput::make('cat_name')
                    ->required(),
                Textarea::make('cat_desc')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
