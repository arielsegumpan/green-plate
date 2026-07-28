<?php

namespace App\Filament\Dashboard\Resources\Categories\Pages;

use App\Filament\Dashboard\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
