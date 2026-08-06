<?php

namespace App\Filament\Dashboard\Resources\FoodCategories\Pages;

use App\Filament\Dashboard\Resources\FoodCategories\FoodCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFoodCategory extends ViewRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
