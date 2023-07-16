<?php

namespace App\Filament\Resources\Core\PermissionResource\Pages;

use App\Filament\Resources\Core\PermissionResource;
use Filament\Resources\Pages\ManageRecords;
use Filament\Pages\Actions;

class ManagePermissions extends ManageRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
