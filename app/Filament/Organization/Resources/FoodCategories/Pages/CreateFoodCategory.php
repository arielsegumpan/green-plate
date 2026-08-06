<?php

namespace App\Filament\Organization\Resources\FoodCategories\Pages;

use App\Filament\Organization\Resources\FoodCategories\FoodCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodCategory extends CreateRecord
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        
        return $data;
    }
}
