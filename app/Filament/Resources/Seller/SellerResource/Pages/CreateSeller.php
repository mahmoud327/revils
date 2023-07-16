<?php

namespace App\Filament\Resources\Seller\SellerResource\Pages;

use App\Filament\Resources\Seller\SellerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeller extends CreateRecord
{
    protected static string $resource = SellerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
