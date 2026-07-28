<?php

namespace App\Filament\Organization\Resources\OrganizationMembers\Pages;

use App\Filament\Organization\Resources\OrganizationMembers\OrganizationMemberResource;
use App\Models\OrganizationMember;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;

class EditOrganizationMember extends EditRecord
{
    protected static string $resource = OrganizationMemberResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var OrganizationMember */
        $record = $this->getRecord();
        return 'Edit ' . $record->user?->name;
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

        unset($data['user']);

        return $data;
    }



}
