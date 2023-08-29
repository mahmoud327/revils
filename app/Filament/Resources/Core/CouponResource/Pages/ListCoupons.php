<?php

namespace App\Filament\Resources\Core\CouponResource\Pages;

use App\Filament\Resources\Core\CouponResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoupons extends ListRecords
{
    protected static string $resource = CouponResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTitle(): string
    {
        return trans('dashboard.coupons.coupons');

    }
}
