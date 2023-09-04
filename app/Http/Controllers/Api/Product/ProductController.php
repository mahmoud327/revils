<?php

namespace App\Http\Controllers\Api\Product;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    public function __construct(public ProductRepositoryInterface $productRepository){}
    public function index()
    {
        $products = ProductResource::collection($this->productRepository->all(paginatePerPage: null))->response()->getData(true);
        return responseSuccess($products);
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

    public function trends(Request $request)
    {
        $products = ProductResource::collection($this->productRepository->trends(paginatePerPage:$request->page))->response()->getData(true);
        return responseSuccess($products);
    }
}
