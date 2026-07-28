<?php

namespace App\Filament\Organization\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')
                    ->description('Category Information')
                    ->aside()
                    ->schema([
                        TextEntry::make('cat_name')
                            ->weight('bold')
                            ->label('Name'),
                        TextEntry::make('cat_desc')
                            ->label('Description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        Group::make([
                            TextEntry::make('created_at')
                                ->dateTime('M j, Y')
                                ->placeholder('-')
                                ->badge()
                                ->color('success'),
                            TextEntry::make('updated_at')
                                ->dateTime('M j, Y')
                                ->placeholder('-')
                                ->badge()
                                ->color('success'),
                        ])
                        ->columns([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2
                        ])
                    ])
                    ->columnSpanFull()
            ]);
    }
}
