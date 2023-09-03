<?php

namespace App\Http\Controllers\Api\Product;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    use PaginationTrait;
    public function __construct(public ProductRepositoryInterface $productRepository)
    {
    }
    public function index(Request $request)
    {
        $products = ProductResource::collection($this->productRepository->all(paginatePerPage: $request->page));
        return responseSuccess($products,$this->buildPaginationMeta($products));
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
        $products = ProductResource::collection($this->productRepository->trends(paginate:$request->page));
        return responseSuccess($products,$this->buildPaginationMeta($products));
    }
}
