<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Schemas;

use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationMemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Member Information')
                    ->description('Manage primary account details, personal information, and contact preferences for this member.')
                    ->aside()
                    ->schema([

                        TextEntry::make('user.name')
                            ->label('Member')
                            ->weight('bold')
                            ->size('lg'),

                        TextEntry::make('user.email')
                            ->label('Email')
                            ->placeholder('-')
                            ->badge()
                            ->color('success')
                            ->copyable()
                            ->copyMessage('Copied to clipboard'),

                        TextEntry::make('position')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->dateTime('M j, Y')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->dateTime('M j, Y')
                            ->placeholder('-'),
                    ])
                    ->columnSpanFull()
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 2,
                        'lg' => 2
                    ])
            ]);
    }
}
