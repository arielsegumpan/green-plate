<?php

namespace App\Enums;

use BackedEnum;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum DeliveryStatusEnums: string implements HasLabel, HasColor, HasIcon
{
    case ASSIGNED = 'assigned';
    case ON_PICKUP = 'on_pickup';
    case PICKED_UP = 'picked_up';
    case ON_DELIVERY = 'on_delivery';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';



    public function getLabel(): string | Htmlable | null
    {

        return match ($this) {
            self::ASSIGNED => 'Assigned',
            self::ON_PICKUP => 'On Pickup',
            self::PICKED_UP => 'Picked Up',
            self::ON_DELIVERY => 'On Delivery',
            self::COMPLETED => 'Completed',
            self::FAILED => 'Failed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ASSIGNED => 'success',
            self::ON_PICKUP => 'warning',
            self::PICKED_UP => 'success',
            self::ON_DELIVERY => 'warning',
            self::COMPLETED => 'success',
            self::FAILED => 'danger',
            self::CANCELLED => 'danger',
        };
    }

    public function getIcon(): string | BackedEnum | Htmlable | null
    {
        return match ($this) {
            self::ASSIGNED => Phosphor::TruckTrailer,
            self::ON_PICKUP => Phosphor::TruckTrailer,
            self::PICKED_UP => Phosphor::TruckTrailer,
            self::ON_DELIVERY => Phosphor::TruckTrailer,
            self::COMPLETED => Phosphor::TruckTrailer,
            self::FAILED => Phosphor::TruckTrailer,
            self::CANCELLED => Phosphor::TruckTrailer,
        };
    }
}
