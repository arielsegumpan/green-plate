<?php

namespace App\Filament\Organization\Resources\Donations\Pages;

use App\Filament\Organization\Resources\Donations\DonationResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->icon(Phosphor::Plus)->label('New Donation'),
        ];
    }
}
