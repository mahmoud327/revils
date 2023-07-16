<?php

namespace App\Filament\Resources\BusinessTypeResource\Pages;

use App\Filament\Resources\Core\BusinessTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessType extends CreateRecord
{
    protected static string $resource = BusinessTypeResource::class;

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
