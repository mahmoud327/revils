<?php

namespace App\Filament\Resources\Product\ProductResource\Pages;

use App\Filament\Resources\Product\ProductResource;
use App\Models\Product\Product;
use App\Models\User;
use Filament\Resources\Pages\Page;

class ShowProduct extends Page
{
    protected static string $resource = ProductResource::class;

    protected static string $view = 'products.rates.index';

    public function getData(): ?object
    {

        dd('dd');
        $id = request()->segment(5);
        $result = Product::with(['user', 'category'])->find($id);

        return $result;
    }
}
