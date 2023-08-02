<?php

namespace App\Filament\Resources\Product\RateResource\Pages;

use App\Filament\Resources\Product\RateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRate extends EditRecord
{
    protected static string $resource = RateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
