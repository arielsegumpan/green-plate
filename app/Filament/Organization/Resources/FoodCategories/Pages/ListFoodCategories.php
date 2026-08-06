<?php

namespace App\Filament\Organization\Resources\FoodCategories\Pages;

use App\Filament\Organization\Resources\FoodCategories\FoodCategoryResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFoodCategories extends ListRecords
{
    protected static string $resource = FoodCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->icon(Phosphor::Plus)->label('New Food Category'),
        ];
    }
}
