<?php

namespace App\Filament\Dashboard\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')
                    ->description('Create a new category for your organization.')
                    ->aside()
                    ->schema([
                        TextInput::make('cat_name')
                            ->label('Name')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->trim()
                            ->unique(column: 'cat_name')
                            ->columnSpanFull()
                            ->validationMessages([
                                'required' => 'Please enter a category name.',
                                'unique' => 'This name already exists.',
                                'min' => 'The name must be at least 3 characters.',
                                'max' => 'The name must not be greater than 255 characters.',
                            ]),
                        Textarea::make('cat_desc')
                            ->label('Description')
                            ->default(null)
                            ->maxLength(500)
                            ->trim()
                            ->columnSpanFull()
                            ->validationMessages([
                                'max' => 'The description must not be greater than 500 characters.',
                            ]),
                    ])
                     ->columnSpanFull()


            ]);
    }
}
