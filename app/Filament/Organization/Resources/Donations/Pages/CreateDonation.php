<?php

namespace App\Filament\Organization\Resources\Donations\Pages;

use App\Enums\DonationStatusEnums;
use App\Filament\Organization\Resources\Donations\DonationResource;
use App\Filament\Organization\Resources\Donations\Schemas\DonationForm;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\Str;

class CreateDonation extends CreateRecord
{
    use HasWizard;

    protected static string $resource = DonationResource::class;

    /**
     * @return array<Step>
     */
    protected function getSteps(): array
    {
        return [
            Step::make('Donation Details')
                ->icon(Phosphor::Receipt)
                ->schema([
                    Section::make()
                        ->schema(DonationForm::getDetailsComponents())
                        ->columns(),
                ]),

            Step::make('Location')
                ->icon(Phosphor::MapPin)
                ->schema([
                    Section::make()
                        ->schema(DonationForm::getLocationComponents())
                        ->columns([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 2,
                            'lg' => 2,
                        ]),
                ]),
            Step::make('Donation Items')
                ->icon(Phosphor::ShoppingCart)
                ->schema([
                    Section::make()
                        ->schema([DonationForm::getDonationItemsRepeater()]),
                ]),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = Str::of($data['name'])->title();
        $data['status'] = DonationStatusEnums::PENDING->value;

        return $data;
    }

    protected function afterSave(): void
    {
        $paths = $this->data['foodImages'] ?? [];

        // wipe and re-create for simplicity, or diff if you want to preserve img_alt etc.
        $this->record->foodImages()->delete();

        foreach ($paths as $path) {
            $this->record->foodImages()->create([
                'organization_id' => $this->record->organization_id,
                'img_path' => $path,
            ]);
        }
    }
}
