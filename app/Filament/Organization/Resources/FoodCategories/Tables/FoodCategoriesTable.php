<?php

namespace App\Filament\Organization\Resources\FoodCategories\Tables;

use App\Filament\Organization\Resources\FoodCategories\FoodCategoryResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FoodCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->searchable(),
                TextColumn::make('co2_factor')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('meal_ratio')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                ->icon(Phosphor::DotsThreeOutlineVertical)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', direction: 'desc')
            ->deferLoading()
            ->emptyStateActions([
                Action::make('create')
                    ->label('New Food Category')
                    ->url(
                        FoodCategoryResource::getUrl('create'))
                    ->icon(Phosphor::Plus)
                    ->button(),
            ])
            ->emptyStateIcon(Phosphor::Bread)
            ->emptyStateHeading('No food categories are created');
    }
}
