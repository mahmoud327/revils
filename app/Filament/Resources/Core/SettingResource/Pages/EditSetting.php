<?php

namespace App\Filament\Resources\Core\SettingResource\Pages;

use App\Filament\Resources\Core\SettingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    use EditRecord\Concerns\Translatable;



    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
   
}
