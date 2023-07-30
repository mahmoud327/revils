<?php

namespace App\Exports;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class ProductExport implements FromView
{

    use Exportable;
    public $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function view(): View
    {

        $items = Product::with(['category', 'attributes', 'user', 'attributeValues'])
            ->whereIn('id', $this->products->pluck('id')
                ->toArray())
            ->get();


        return view('products.export', compact('items'));
    }
}
