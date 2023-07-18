<?php

namespace App\Filament\Resources\Product\AttributeValueResource\Pages;

use App\Filament\Resources\Product\AttributeValueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttributeValues extends ListRecords
{
    protected static string $resource = AttributeValueResource::class;
    use ListRecords\Concerns\Translatable;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
