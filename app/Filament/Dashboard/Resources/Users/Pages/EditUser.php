<?php

namespace App\Filament\Dashboard\Resources\Users\Pages;

use App\Filament\Dashboard\Resources\Users\UserResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->icon(Phosphor::Eye),
            DeleteAction::make()->icon(Phosphor::Trash),
            ForceDeleteAction::make()->icon(Phosphor::Trash),
            RestoreAction::make()->icon(Phosphor::ArrowsClockwise),
        ];
    }
}
