<?php

namespace App\Filament\Resources\Core\StateResource\Pages;

use App\Filament\Resources\Core\StateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStates extends ListRecords
{
    protected static string $resource = StateResource::class;
    use ListRecords\Concerns\Translatable;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
    protected function getTitle(): string
    {
        return trans('dashboard.states');

    }
}
