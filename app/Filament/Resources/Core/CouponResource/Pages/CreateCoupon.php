<?php

namespace App\Filament\Resources\Core\CouponResource\Pages;

use App\Filament\Resources\Core\CouponResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCoupon extends CreateRecord
{
    protected static string $resource = CouponResource::class;


    use CreateRecord\Concerns\Translatable;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    
}
