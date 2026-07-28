<?php

namespace App\Filament\Dashboard\Resources\Users\Schemas;

use App\Models\User;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('roles.name')
                            ->label('Role')
                            ->badge()
                            ->color('success')
                            ->formatStateUsing(fn(string $state): string => str($state)->replace('_', ' ')->title()->toString()),
                        TextEntry::make('email')
                            ->label('Email address'),
                        TextEntry::make('email_verified_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->dateTime()
                            ->visible(fn(User $record): bool => $record->trashed()),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 3,
                        'lg' => 3
                    ])
                    ->columnSpanFull()
            ]);
    }
}
