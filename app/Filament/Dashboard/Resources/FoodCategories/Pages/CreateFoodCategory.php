<?php

namespace App\Filament\Dashboard\Resources\FoodCategories\Pages;

use App\Filament\Dashboard\Resources\FoodCategories\FoodCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodCategory extends CreateRecord
{
    protected static string $resource = FoodCategoryResource::class;
}
