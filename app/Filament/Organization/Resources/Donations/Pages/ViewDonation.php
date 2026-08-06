<?php

namespace App\Filament\Organization\Resources\Donations\Pages;

use App\Filament\Organization\Resources\Donations\DonationResource;
use App\Models\Donation;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewDonation extends ViewRecord
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon(Phosphor::Pencil),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        /** @var Donation */
        $record = $this->getRecord();
        return $record->reference_no;
    }

}
