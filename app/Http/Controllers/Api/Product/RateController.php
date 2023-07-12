<?php

namespace App\Http\Controllers\Api\Product;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rate\RateRequest;
use App\Models\Product\Product;
use App\Repositories\Product\Rate\RateRepositoryInterface;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct(public RateRepositoryInterface $rateRepository)
    {
    }

    public function store(RateRequest $request, Product $product)
    {
        $this->rateRepository->store(request: $request, product: $product);
        return responseSuccess([], __('lang.products.rates.rated'));
    }
}
