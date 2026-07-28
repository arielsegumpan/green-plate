<?php

namespace App\Filament\Dashboard\Resources\Categories\Pages;

use App\Filament\Dashboard\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

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
