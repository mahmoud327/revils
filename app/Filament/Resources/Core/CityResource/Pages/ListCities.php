<?php

namespace App\Filament\Resources\Core\CityResource\Pages;

use App\Filament\Resources\Core\CityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTitle(): string
    {
        return trans('dashboard.cities');

    }

}
