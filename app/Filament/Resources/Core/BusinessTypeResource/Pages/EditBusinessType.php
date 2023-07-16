<?php

namespace App\Filament\Resources\BusinessTypeResource\Pages;

use App\Filament\Resources\Core\BusinessTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessType extends EditRecord
{
    protected static string $resource = BusinessTypeResource::class;
    use EditRecord\Concerns\Translatable;


    protected function getActions(): array
    {
        return [

            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


}
