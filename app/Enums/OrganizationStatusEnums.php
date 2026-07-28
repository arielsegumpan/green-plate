<?php

namespace App\Enums;

use BackedEnum;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum OrganizationStatusEnums: string implements HasLabel, HasColor, HasIcon
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';


    public function getLabel(): string | Htmlable | null
    {

        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::SUSPENDED => 'Suspended',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
            self::SUSPENDED => 'warning',
        };
    }

    public function getIcon(): string | BackedEnum | Htmlable | null
    {
        return match ($this) {
            self::ACTIVE => Phosphor::CheckCircle,
            self::INACTIVE => Phosphor::XCircle,
            self::SUSPENDED => Phosphor::WarningCircle,
        };
    }
}
