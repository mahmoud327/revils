<?php

namespace App\Filament\Resources\Core\CategoryResource\Pages;

use App\Filament\Resources\Core\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;


class ListCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
            ImportAction::make()
              //  ->handleBlankRows(true)
                ->fields([
                    ImportField::make('name')
                        ->label('name')
                        ->helperText('Define as name helper'),
                    ImportField::make('color')
                        ->label('color'),
                ])
        ];
    }
    protected function getTitle(): string
    {
        return trans('dashboard.categories.categories');

    }
}
