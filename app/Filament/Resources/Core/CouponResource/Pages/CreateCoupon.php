<?php

namespace App\Filament\Resources\Core\CouponResource\Pages;

use App\Filament\Resources\Core\CouponResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCoupon extends CreateRecord
{
    protected static string $resource = CouponResource::class;



    protected function getActions(): array
    {
        return [
            // ...
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }



}
