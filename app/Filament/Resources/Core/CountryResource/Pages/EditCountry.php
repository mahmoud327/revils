<?php

namespace App\Filament\Resources\Core\CountryResource\Pages;

use App\Filament\Resources\Core\CountryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;
    use EditRecord\Concerns\Translatable;


    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
