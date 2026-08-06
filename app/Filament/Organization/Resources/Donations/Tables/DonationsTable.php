<?php

namespace App\Filament\Organization\Resources\Donations\Tables;

use App\Filament\Organization\Resources\Donations\DonationResource;
use App\Models\Donation;
use App\Models\DonationItem;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('food_images')
                    ->label('Attachments')
                    ->getStateUsing(function (Donation $record): array {
                        return $record->donationItems
                            ->flatMap(function (DonationItem $item) {
                                return data_get($item->food_imgs, 'images', []);
                            })
                            ->values()
                            ->all();
                    })
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(size: 'lg')
                    ->disk('public')
                    ->ring(5)
                    ->imageSize(50),

                TextColumn::make('organization.org_name')
                    ->searchable(),
                TextColumn::make('reference_no')
                    ->searchable(),
                TextColumn::make('available_from')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
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
                    ->icon(Phosphor::DotsThreeCircleVertical),
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
                    ->label('New Donation')
                    ->url(DonationResource::getUrl('create'))
                    ->icon(Phosphor::Plus)
                    ->button(),
            ])
            ->emptyStateIcon(Phosphor::HandHeart)
            ->emptyStateHeading('No donations are created');
    }
}
