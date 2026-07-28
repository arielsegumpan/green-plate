<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum OrganizationTypeEnums: string implements HasLabel
{
    case DONOR = 'donor';
    case RECIPIENT = 'recipient';
    case BOTH = 'both';

    public function getLabel(): string | Htmlable | null
    {

        return match ($this) {
            self::DONOR => 'Donor',
            self::RECIPIENT => 'Recipient',
            self::BOTH => 'Both',
        };
    }
}
