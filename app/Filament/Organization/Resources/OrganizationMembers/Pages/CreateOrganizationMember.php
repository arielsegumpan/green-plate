<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Pages;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateOrganizationMember extends CreateRecord
{
    protected static string $resource = OrganizationMemberResource::class;
    protected ?User $newUser = null;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userData = $data['user'];

        $this->newUser = User::create([
            'name' => Str::ucwords($userData['name']),
            'email' => Str::lower($userData['email']),
            'password' => Hash::make($userData['password']),
        ]);

        $data['user_id'] = $this->newUser->id;

        unset($data['user']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->newUser?->assignRole('driver');
    }
}
