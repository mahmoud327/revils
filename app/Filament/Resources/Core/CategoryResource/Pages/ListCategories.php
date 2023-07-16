<?php

namespace App\Filament\Resources\Core\CategoryResource\Pages;

use App\Filament\Resources\Core\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
