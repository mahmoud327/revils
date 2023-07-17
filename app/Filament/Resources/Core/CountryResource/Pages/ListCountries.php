<?php

namespace App\Filament\Resources\Core\CountryResource\Pages;

use App\Filament\Resources\Core\CountryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCountries extends ListRecords
{
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}