<?php

namespace App\Filament\Resources\Core\StateResource\Pages;

use App\Filament\Resources\Core\StateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateState extends CreateRecord
{
    protected static string $resource = StateResource::class;
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
