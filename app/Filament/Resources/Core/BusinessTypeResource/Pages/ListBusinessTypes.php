<?php

namespace App\Filament\Resources\BusinessTypeResource\Pages;

use App\Filament\Resources\Core\BusinessTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessTypes extends ListRecords
{
    protected static string $resource = BusinessTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTitle(): string
    {
        return trans('dashboard.business types');

    }
}
