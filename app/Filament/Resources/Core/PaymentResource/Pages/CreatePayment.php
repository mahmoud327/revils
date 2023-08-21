<?php

namespace App\Filament\Resources\Core\PaymentResource\Pages;

use App\Filament\Resources\Core\PaymentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
