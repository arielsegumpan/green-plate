<?php

namespace App\Filament\Organization\Resources\Categories\Tables;

use App\Filament\Organization\Resources\Categories\CategoryResource;
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

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cat_name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cat_desc')
                    ->label('Description')
                    ->wrap()
                    ->limit(50),
                TextColumn::make('created_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
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
                ->icon(Phosphor::DotsThreeCircleVertical)
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
                    ->label('New Plan')
                    ->url(CategoryResource::getUrl('create'))
                    ->icon(Phosphor::Plus)
                    ->button(),
            ])
            ->emptyStateIcon(Phosphor::Stack)
            ->emptyStateHeading('No categories are created');
    }
}
