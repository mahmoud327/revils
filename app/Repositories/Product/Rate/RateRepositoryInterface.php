<?php

namespace App\Repositories\Product\Rate;



interface RateRepositoryInterface
{
    public function store($request, $product);
}
