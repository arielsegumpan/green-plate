<?php

namespace App\Enums;

use BackedEnum;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum DonationStatusEnums: string implements HasLabel, HasColor, HasIcon
{
    case PENDING = 'pending';
    case MATCHED = 'matched';
    case ASSIGNED = 'assigned';
    case PICKED_UP = 'picked_up';
    case ON_DELIVERY = 'on_delivery';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';




    public function getLabel(): string | Htmlable | null
    {

        return match ($this) {
            self::PENDING => 'Pending',
            self::MATCHED => 'Matched',
            self::ASSIGNED => 'Assigned',
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
            self::PENDING => 'success',
            self::MATCHED => 'success',
            self::ASSIGNED => 'success',
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
            self::PENDING => Phosphor::ClockCounterClockwise,
            self::MATCHED => Phosphor::ThumbsUp,
            self::ASSIGNED => Phosphor::HandArrowUp,
            self::PICKED_UP => Phosphor::HandWithdraw,
            self::ON_DELIVERY => Phosphor::TruckTrailer,
            self::COMPLETED => Phosphor::CheckCircle,
            self::FAILED => Phosphor::XCircle,
            self::CANCELLED => Phosphor::XCircle,
        };
    }
}
