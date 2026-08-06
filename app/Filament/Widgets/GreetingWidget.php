<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class GreetingWidget extends Widget
{
    protected string $view = 'filament.widgets.greeting-widget';

    public function getGreeting(): string
    {
        $hour = now()->hour;

        return match (true) {
            $hour < 12 => 'Welcome, Good morning',
            $hour < 18 => 'Welcome, Good afternoon',
            default => 'Welcome, Good evening',
        };
    }
}
