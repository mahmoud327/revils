<?php

namespace App\Filament\Resources\Core\RoleResource\Pages;

use App\Filament\Resources\Core\RoleResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
