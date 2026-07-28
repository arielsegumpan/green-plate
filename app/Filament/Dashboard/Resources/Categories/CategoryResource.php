<?php

namespace App\Filament\Dashboard\Resources\Categories;

use App\Filament\Dashboard\Resources\Categories\Pages\CreateCategory;
use App\Filament\Dashboard\Resources\Categories\Pages\EditCategory;
use App\Filament\Dashboard\Resources\Categories\Pages\ListCategories;
use App\Filament\Dashboard\Resources\Categories\Pages\ViewCategory;
use App\Filament\Dashboard\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Dashboard\Resources\Categories\Schemas\CategoryInfolist;
use App\Filament\Dashboard\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Phosphor::Stack;

    protected static ?string $recordTitleAttribute = 'cat_name';

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'view' => ViewCategory::route('/{record}'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
