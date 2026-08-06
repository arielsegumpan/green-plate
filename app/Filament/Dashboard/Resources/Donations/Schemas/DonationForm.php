<?php

namespace App\Filament\Dashboard\Resources\Donations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('organization_id')
                    ->relationship('organization', 'id')
                    ->required(),
                TextInput::make('reference_no')
                    ->required(),
                DateTimePicker::make('available_from')
                    ->required(),
                DateTimePicker::make('expires_at')
                    ->required(),
                Select::make('status')
                    ->options([
            'pending' => 'Pending',
            'matched' => 'Matched',
            'assigned' => 'Assigned',
            'picked_up' => 'Picked up',
            'delivered' => 'Delivered',
            'expired' => 'Expired',
            'cancelled' => 'Cancelled',
        ])
                    ->required(),
            ]);
    }
}
