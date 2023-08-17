<?php

namespace App\Http\Controllers\Api\Seller;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Seller\SelllerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    public function __construct(public SelllerRepositoryInterface $sellerRepository, public ProductRepositoryInterface $productRepository)
    {
    }
    public function index(Request $request)
    {
        $products = ProductResource::collection($this->sellerRepository->getProducts(paginatePerPage: $request->perPage));
        return responseSuccess($products);
    }
    public function store(ProductRequest $request)
    {
        try {
            $this->productRepository->create(data: $request);
            return responseSuccess([], __('lang.products.added'));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }
    public function update(ProductRequest $request, $id)
    {
        try {
            $this->productRepository->update(id: $id, data: $request);
            return responseSuccess([], __('lang.products.updated'));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productRepository->show(id: $id);
            return responseSuccess(new ProductResource($product));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }
    public function destroy($id)
    {
        try {
            $this->productRepository->destroy(id: $id);
            return responseSuccess([], __('lang.products.deleted'));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }
}
