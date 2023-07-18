<?php

namespace App\Filament\Resources\Product\AttributeResource\Pages;

use App\Filament\Resources\Product\AttributeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttributes extends ListRecords
{
    protected static string $resource = AttributeResource::class;
    use ListRecords\Concerns\Translatable;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),

        ];
    }
}
