<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Pages;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EditOrganizationMember extends EditRecord
{
    protected static string $resource = OrganizationMemberResource::class;

    public function getTitle(): string|Htmlable
    {
        /** @var OrganizationMember */
        $record = $this->getRecord();

        return 'Edit '.$record->user?->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->icon(Phosphor::Eye),
            DeleteAction::make()->icon(Phosphor::Trash),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['user'] = $this->record->user?->only(['name', 'email']) ?? [];
        $data['role_id'] = $this->record->user?->roles()->first()?->id;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $userData = $data['user'] ?? [];

        $updatePayload = [
            'name' => $userData['name'] ?? $this->record->user->name,
            'email' => $userData['email'] ?? $this->record->user->email,
        ];

        // Only update the password if the admin actually typed a new one
        if (! empty($userData['password'])) {
            $updatePayload['password'] = Hash::make($userData['password']);
        }

        $this->record->user?->update($updatePayload);

        $roleId = $this->data['role_id'] ?? null;
        $data['position'] = $roleId
            ? Str::of(Role::find($roleId)?->name)->title()
            : $this->record->position;

        unset($data['user']);

        return $data;
    }

    protected function afterSave(): void
    {
        $roleId = $this->data['role_id'] ?? null;

        if ($roleId) {
            $role = Role::find($roleId);
            $this->record->user?->syncRoles([$role]);
        }
    }
}
