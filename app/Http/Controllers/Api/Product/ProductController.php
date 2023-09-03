<?php

namespace App\Http\Controllers\Api\Product;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    use PaginationTrait;
    public function __construct(public ProductRepositoryInterface $productRepository){}
    public function index(Request $request)
    {
        $products = ProductResource::collection($this->productRepository->all(paginatePerPage: $request->perPage));
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

    public function trends($perPage=null)
    {
        $products = ProductResource::collection($this->productRepository->trends(paginatePerPage: $perPage));
        return responseSuccess($products);
    }
}
