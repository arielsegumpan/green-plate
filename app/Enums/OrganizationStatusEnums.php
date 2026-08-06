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
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';


    public function getLabel(): string | Htmlable | null
    {

        return match ($this) {
            self::PENDING => 'Pending',
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }

    public function getIcon(): string | BackedEnum | Htmlable | null
    {
        return match ($this) {
            self::PENDING => Phosphor::ClockCounterClockwise,
            self::ACTIVE => Phosphor::CheckCircle,
            self::INACTIVE => Phosphor::WarningCircle,
        };
    }
}
