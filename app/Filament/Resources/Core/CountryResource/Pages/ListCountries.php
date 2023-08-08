<?php

namespace App\Filament\Resources\Core\CountryResource\Pages;

use App\Filament\Resources\Core\CountryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCountries extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
    protected function getTitle(): string
    {
        return trans('dashboard.countries');
    }
}
