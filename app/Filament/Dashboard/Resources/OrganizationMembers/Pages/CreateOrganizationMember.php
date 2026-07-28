<?php

namespace App\Filament\Dashboard\Resources\OrganizationMembers\Pages;

use App\Filament\Dashboard\Resources\OrganizationMembers\OrganizationMemberResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganizationMember extends CreateRecord
{
    protected static string $resource = OrganizationMemberResource::class;
}
