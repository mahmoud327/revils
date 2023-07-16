<?php

namespace App\Filament\Resources\Core\CategoryResource\Pages;

use App\Filament\Resources\Core\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;


class EditCategory extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

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
