<?php

namespace App\Filament\Resources\Product\ProductResource\Pages;

use App\Filament\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Filament\Pages\Actions;
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
                ->handleBlankRows(true)

                ->fields([
                    ImportField::make('name')
                        ->required(),

                    ImportField::make('description')
                        ->required(),

                    ImportField::make('user_id')
                        ->required(),
                    ImportField::make('price'),
                    ImportField::make('weight'),
                    ImportField::make('unit'),
                    ImportField::make('is_liquid_shipping'),
                    ImportField::make('weight'),
                    ImportField::make('is_handcrafted'),
                    ImportField::make('status'),
                    ImportField::make('quantity'),
                    ImportField::make('category_id'),
                    ImportField::make('item_type'),

                    // ImportField::make('user'),
                    // ImportField::make('attributes')->relationship('attributeValues'),
                ]),



            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $products = (new Product)::query();
        if (auth()->user()->hasRole('seller')) {
            return $products->whereUserId(auth()->id())
                ->latest();
        }
        return $products->latest();
    }
    protected function getTitle(): string
    {
        return trans('dashboard.products.products');
    }
}
