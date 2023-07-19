<?php

namespace App\Exports;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;



class ProductExport implements FromQuery
{

    use Exportable;
    public $products;

    public function __construct(Collection $products)
    {
        $this->products=$products;

    }

    public function query()
    {
        return Product::whereKey($this->products->pluck('id')->toArray());
    }
}
