<?php

namespace App\Filament\Dashboard\Resources\OrganizationMembers\Pages;

use App\Filament\Dashboard\Resources\OrganizationMembers\OrganizationMemberResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrganizationMember extends ViewRecord
{
    protected static string $resource = OrganizationMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
