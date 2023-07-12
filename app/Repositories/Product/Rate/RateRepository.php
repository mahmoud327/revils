<?php


namespace App\Repositories\Product\Rate;


class RateRepository  implements RateRepositoryInterface
{

    public function store($request, $product)
    {
        return  auth()->user()->setRateType('products')
            ->rate($product, $request->rate);
    }
}
