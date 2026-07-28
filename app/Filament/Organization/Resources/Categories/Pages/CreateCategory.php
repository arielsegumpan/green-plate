<?php

namespace App\Filament\Organization\Resources\Categories\Pages;

use App\Filament\Organization\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['cat_name'] = ucfirst($data['cat_name']);
        return $data;
    }
}
