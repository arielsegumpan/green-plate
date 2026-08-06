<?php

namespace App\Filament\Dashboard\Resources\Donations\Pages;

use App\Filament\Dashboard\Resources\Donations\DonationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDonation extends CreateRecord
{
    protected static string $resource = DonationResource::class;
}
