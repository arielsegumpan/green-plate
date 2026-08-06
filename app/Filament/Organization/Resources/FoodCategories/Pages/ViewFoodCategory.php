<?php

namespace App\Filament\Organization\Resources\FoodCategories\Pages;

use App\Filament\Organization\Resources\FoodCategories\FoodCategoryResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFoodCategory extends ViewRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon(Phosphor::Pencil),
        ];
    }
}
