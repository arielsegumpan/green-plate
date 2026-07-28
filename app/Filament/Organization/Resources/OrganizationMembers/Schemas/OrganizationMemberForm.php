<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Schemas;

use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Member Information')
                    ->icon(Phosphor::UsersFour)
                    ->description('Manage primary account details, personal information, and contact preferences for this member.')
                    ->aside()
                    ->schema([

                        TextInput::make('user.name')
                            ->minLength(3)
                            ->maxLength(255)
                            ->required()
                            ->validationMessages([
                                'required' => 'Please enter a name.',
                                'min' => 'The name must be at least 3 characters.',
                                'max' => 'The name must not exceed 255 characters.',
                            ]),

                        TextInput::make('user.email')
                            ->email()
                            ->minLength(3)
                            ->maxLength(255)
                            ->required()
                            ->validationMessages([
                                'required' => 'Please enter a name.',
                                'min' => 'The name must be at least 3 characters.',
                                'max' => 'The name must not exceed 255 characters.',
                                'email' => 'Please enter a valid email address.',
                            ]),

                        TextInput::make('user.password')
                            ->password()
                            ->minLength(8)
                            ->maxLength(255)
                            ->required()
                            ->revealable()
                            ->confirmed()
                            ->validationMessages([
                                'confirmed' => 'The provided passwords do not match.',
                                'required' => 'Please enter a password.',
                                'min' => 'The password must be at least 8 characters.',
                                'max' => 'The password must not exceed 255 characters.',
                            ]),

                        TextInput::make('user.password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->minLength(8)
                            ->maxLength(255)
                            ->required()
                            ->revealable()
                            ->dehydrated(false) // don't persist this field, it's only for validation
                            ->validationMessages([
                                'required' => 'Please confirm your password.',
                                'min' => 'The password must be at least 8 characters.',
                                'max' => 'The password must not exceed 255 characters.',
                            ]),
                        TextInput::make('position')
                            ->default(null)
                            ->minLength(3)
                            ->maxLength(255)
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull()
                    ->columns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2
                    ])
            ]);
    }
}
