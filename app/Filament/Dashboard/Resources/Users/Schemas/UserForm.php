<?php

namespace App\Filament\Dashboard\Resources\Users\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->minLength(3),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->minLength(3),
                    DateTimePicker::make('email_verified_at')
                        ->native(false),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->maxLength(255),
                ])
                ->columns([
                    'default' => 1,
                    'md' => 2,
                    'lg' => 2
                ])
                ->columnSpanFull(),

                Section::make()
                ->schema([
                    CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(
                        fn (Role $record) => Str::of($record->name)->replace('_', ' ')->title()
                    ),
                ])
                ->columnSpanFull()
            ]);
    }
}
