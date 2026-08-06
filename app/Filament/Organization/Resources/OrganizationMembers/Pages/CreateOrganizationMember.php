<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Pages;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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

        $roleId = $this->data['role_id'] ?? null;
        $data['position'] = $roleId
            ? Str::of(Role::find($roleId)?->name)->title()
            : null;

        unset($data['user']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $roleId = $this->data['role_id'] ?? null;
        if ($roleId) {
            $role = Role::find($roleId);
            $this->record->user->syncRoles([$role]);
        }
        // $this->newUser?->assignRole('driver');
    }
}
