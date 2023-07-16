<?php

namespace App\Filament\Resources\Seller\SellerResource\Pages;

use App\Filament\Resources\Seller\SellerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeller extends EditRecord
{
    protected static string $resource = SellerResource::class;

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
