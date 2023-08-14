<?php

namespace App\Filament\Resources\Customer\ProductResource\Pages;

use App\Filament\Resources\Product\ProductResource;
use App\Models\Product\Product;
use App\Models\User;
use Filament\Resources\Pages\Page;


use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowProductRates extends Page
{
    protected static string $resource = ProductResource::class;

    protected static string $view = 'products.rates.index';


    public function getData(): ?object
    {

        $id = request()->segment(4);

        $product = Product::find($id);
        $rates = $product->raters('rating')->paginate();

        return $rates;
    }

    protected function tableSearchQuery(){
        dd('dd');
    }
}
