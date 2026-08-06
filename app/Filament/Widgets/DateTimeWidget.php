<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DateTimeWidget extends Widget
{
    protected string $view = 'filament.widgets.date-time-widget';

    public function getServerTimestamp(): int
    {
        return now()->getTimestamp() * 1000; // JS uses milliseconds
    }

    public function getTimezone(): string
    {
        return config('app.timezone');
    }
}
