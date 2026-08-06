<?php

namespace App\Filament\Dashboard\Resources\FoodCategories\Pages;

use App\Filament\Dashboard\Resources\FoodCategories\FoodCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFoodCategory extends EditRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
