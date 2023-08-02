<?php

namespace App\Filament\Resources\Customer\CustomerResource\Pages;

use App\Filament\Resources\Customer\CustomerResource;
use App\Models\Product\Product;
use App\Models\User;
use Filament\Resources\Pages\Page;

class ShowProduct extends Page
{
    protected static string $resource = CustomerResource::class;

    protected static string $view = 'products.show';

    public function getData(): ?object
    {

        $id = request()->segment(5);
        $result = Product::with(['user', 'category'])->find($id);

        return $result;
    }
}
