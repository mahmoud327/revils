<?php

namespace App\Filament\Resources\Product\RateResource\Pages;

use App\Filament\Resources\Product\RateResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Multicaret\Acquaintances\Interaction;

class ListRates extends ListRecords
{
    protected static string $resource = RateResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Interaction::where('relation','rating')
            ->latest();
    }
}
