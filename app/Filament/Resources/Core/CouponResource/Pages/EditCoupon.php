<?php

namespace App\Filament\Resources\Core\CouponResource\Pages;

use App\Filament\Resources\Core\CouponResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoupon extends EditRecord
{
    protected static string $resource = CouponResource::class;

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
