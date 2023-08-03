<?php

namespace App\Filament\Resources\Core\SettingResource\Pages;

use App\Filament\Resources\Core\SettingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }
}
