<?php

namespace App\Filament\Resources\Core\RoleResource\Pages;

use App\Filament\Resources\Core\RoleResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTitle(): string
    {
        return trans('dashboard.roles.roles');

    }
}
