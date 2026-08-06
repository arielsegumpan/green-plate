<?php

namespace App\Filament\Organization\Resources\FoodCategories\Pages;

use App\Filament\Organization\Resources\FoodCategories\FoodCategoryResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditFoodCategory extends EditRecord
{
    protected static string $resource = FoodCategoryResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var FoodCategory */
        $record = $this->getRecord();
        return 'Edit ' . $record->name;
    }

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
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

}
