<?php

namespace App\Filament\Resources\Core\CountryResource\Pages;

use App\Filament\Resources\Core\CountryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;
}
