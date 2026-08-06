<?php

namespace App\Filament\Dashboard\Resources\FoodCategories;

use App\Filament\Dashboard\Resources\FoodCategories\Pages\CreateFoodCategory;
use App\Filament\Dashboard\Resources\FoodCategories\Pages\EditFoodCategory;
use App\Filament\Dashboard\Resources\FoodCategories\Pages\ListFoodCategories;
use App\Filament\Dashboard\Resources\FoodCategories\Pages\ViewFoodCategory;
use App\Filament\Dashboard\Resources\FoodCategories\Schemas\FoodCategoryForm;
use App\Filament\Dashboard\Resources\FoodCategories\Schemas\FoodCategoryInfolist;
use App\Filament\Dashboard\Resources\FoodCategories\Tables\FoodCategoriesTable;
use App\Models\FoodCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FoodCategoryResource extends Resource
{
    protected static ?string $model = FoodCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FoodCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FoodCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FoodCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFoodCategories::route('/'),
            'create' => CreateFoodCategory::route('/create'),
            'view' => ViewFoodCategory::route('/{record}'),
            'edit' => EditFoodCategory::route('/{record}/edit'),
        ];
    }
}
