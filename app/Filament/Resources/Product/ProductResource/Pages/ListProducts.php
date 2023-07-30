<?php

namespace App\Filament\Resources\Product\ProductResource\Pages;

use App\Filament\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Filament\Pages\Actions;
use Filament\Tables\Actions\Action;

use Filament\Forms\Components\Select;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;


class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {

        return [
            ImportAction::make()
                ->fields([
                    ImportField::make('name')
                        ->required(),

                    ImportField::make('description')
                        ->required(),

                ], columns: 2),



            ];
    }

    protected function getTableQuery(): Builder
    {
        return Product::query()
            ->latest();
    }
}
