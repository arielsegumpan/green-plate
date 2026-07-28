<?php

namespace App\Filament\Dashboard\Resources\Users\Pages;

use App\Filament\Dashboard\Resources\Users\UserResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon(Phosphor::NotePencil),
        ];
    }
}
