<?php


namespace App\Repositories\Product\Rate;


class RateRepository  implements RateRepositoryInterface
{

    public function store($request, $product)
    {
        return  auth()->user()->setRateType($request->comment)
            ->rate($product, $request->rate);
    }
}
