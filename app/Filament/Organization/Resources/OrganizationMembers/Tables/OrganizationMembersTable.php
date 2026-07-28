<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Tables;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
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

class OrganizationMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('position')
                    ->sortable()
                    ->searchable(),

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
                    ->label('New Member')
                    ->url(
                        OrganizationMemberResource::getUrl('create'))
                    ->icon(Phosphor::Plus)
                    ->button(),
            ])
            ->emptyStateIcon(Phosphor::UsersFour)
            ->emptyStateHeading('No organization members are created');
    }
}
