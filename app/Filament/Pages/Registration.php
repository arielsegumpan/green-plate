<?php

namespace App\Filament\Pages;

use App\Models\User;
use Caresome\FilamentAuthDesigner\Concerns\HasAuthDesignerLayout;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Registration extends BaseRegister
{
    use HasAuthDesignerLayout;

    public function form(Schema  $schema): Schema
    {
        return $schema
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $sanitizedData = $this->sanitizeInputData($data);

        $user = User::create($sanitizedData);
        $this->assignUserProfileRole($user);
        return $user;
    }


    protected function sanitizeInputData(array $data): array
    {
        return [
            'name' => htmlspecialchars(strip_tags($data['name'])),
            'email' => filter_var(strip_tags($data['email']), FILTER_SANITIZE_EMAIL),
            'password' => $data['password'],
        ];
    }

    protected function assignUserProfileRole(User $user)
    {
        $userRole = Role::updateOrCreate(
            ['name' => 'organization'],
            ['guard_name' => 'web']
        );

        return $user->assignRole($userRole);
    }

    protected function getAuthDesignerPageKey(): string
    {
        return 'registration';
    }
}
