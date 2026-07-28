<?php

namespace App\Filament\Organization\Resources\Categories\Pages;

use App\Filament\Organization\Resources\Categories\CategoryResource;
use App\Models\Category;
use Filafly\Icons\Phosphor\Enums\Phosphor;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon(Phosphor::Pencil),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        /** @var Category */
        $record = $this->getRecord();
        return $record->cat_name;
    }
}
