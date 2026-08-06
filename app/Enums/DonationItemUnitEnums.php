<?php

namespace App\Enums;

use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum DonationItemUnitEnums: string implements HasLabel, HasColor
{
    case KG = 'kg';
    case PCS = 'pcs';
    case BOX = 'box';
    case TRAY = 'tray';




    public function getLabel(): string | Htmlable | null
    {

        return match ($this) {
            self::KG => 'Kg',
            self::PCS => 'Pcs',
            self::BOX => 'Box',
            self::TRAY => 'Tray',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::KG => 'success',
            self::PCS => 'success',
            self::BOX => 'success',
            self::TRAY => 'success',
        };
    }

}
