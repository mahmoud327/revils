<?php

namespace App\Filament\Resources\Product\AttributeValueResource\Pages;

use App\Filament\Resources\Product\AttributeValueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttributeValue extends CreateRecord
{
    protected static string $resource = AttributeValueResource::class;

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
