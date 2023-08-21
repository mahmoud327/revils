<?php

namespace App\Filament\Resources\Core\PaymentResource\Pages;

use App\Filament\Resources\Core\PaymentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

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
