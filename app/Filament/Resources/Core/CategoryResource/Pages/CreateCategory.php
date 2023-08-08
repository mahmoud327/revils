<?php

namespace App\Filament\Resources\Core\CategoryResource\Pages;

use App\Filament\Resources\Core\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;


class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;


    use CreateRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
}
