<?php

namespace App\Filament\Dashboard\Resources\Donations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DonationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('organization.id')
                    ->label('Organization'),
                TextEntry::make('reference_no'),
                TextEntry::make('available_from')
                    ->dateTime(),
                TextEntry::make('expires_at')
                    ->dateTime(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
