<?php

namespace App\Filament\Organization\Resources\Categories\Pages;

use App\Filament\Organization\Resources\Categories\CategoryResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->icon(Phosphor::Eye),
            DeleteAction::make()->icon(Phosphor::Trash),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
