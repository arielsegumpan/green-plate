<?php

namespace App\Filament\Pages;

use App\Enums\OrganizationTypeEnums;
use App\Models\User;
use Caresome\FilamentAuthDesigner\Concerns\HasAuthDesignerLayout;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Group;
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
                Group::make([
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2
                    ]),
                $this->selectType(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function selectType(): Component
    {
        return  Select::make('type')
            ->prefixIcon(Phosphor::HandHeart)
            ->placeholder('Organization Type')
            ->helperText('Please select what type of organization you represent.')
            ->required()
            ->native(false)
            ->options(OrganizationTypeEnums::class)
            ->default(OrganizationTypeEnums::DONOR)
            ->enum(OrganizationTypeEnums::class)
            ->dehydrated()
            ->validationMessages([
                'required' => 'Please select an organization type.',
            ]);
    }
    protected function handleRegistration(array $data): Model
    {
        $sanitizedData = $this->sanitizeInputData($data);
        $type = $sanitizedData['type'];
        $user = User::create($sanitizedData);
        $this->assignUserProfileRole($user, $type);
        return $user;
    }


    protected function sanitizeInputData(array $data): array
    {
        return [
            'name' => htmlspecialchars(strip_tags(trim($data['name']))),
            'email' => trim(filter_var(strip_tags($data['email']), FILTER_SANITIZE_EMAIL)),
            'password' => $data['password'],
            'type' => $data['type']
        ];
    }

    protected function assignUserProfileRole(User $user, OrganizationTypeEnums $type)
    {
        $role = Role::firstOrCreate(
            ['name' => $type, 'guard_name' => 'web']
        );
        return $user->assignRole($role);
    }

    protected function getAuthDesignerPageKey(): string
    {
        return 'registration';
    }
}
