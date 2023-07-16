<?php

namespace App\Filament\Resources\Core\RoleResource\Pages;

use App\Filament\Resources\Core\RoleResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
