<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Pages;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
use App\Models\OrganizationMember;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewOrganizationMember extends ViewRecord
{
    protected static string $resource = OrganizationMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon(Phosphor::Pencil),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        /** @var OrganizationMember */
        $record = $this->getRecord();
        return 'View ' . $record->user->name;
    }
}
