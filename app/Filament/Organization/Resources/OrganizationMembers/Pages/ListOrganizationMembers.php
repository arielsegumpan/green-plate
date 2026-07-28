<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Pages;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrganizationMembers extends ListRecords
{
    protected static string $resource = OrganizationMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->icon(Phosphor::Plus)->label('New Member'),
        ];
    }
}
