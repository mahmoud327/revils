<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Image\ImageRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Core\MediaCenter;
use App\Models\Product\Product;
use App\Repositories\Product\Image\ImageRepositoryInterface;
use Illuminate\Http\Request;


class ProductImageController extends Controller
{
    public function __construct(public ImageRepositoryInterface $imageRepository)
    {
    }

    public function index(Product $product)
    {
        $productImages = $this->imageRepository->index($product);
        return responseSuccess($productImages);
    }

    public function store(ImageRequest $request, Product $product)
    {
        $this->imageRepository->store($request, $product);
        return responseSuccess($product->images);
    }
    public function destroy(Product $product, MediaCenter $image)
    {
        $this->imageRepository->destroy($product,$image);
        return responseSuccess([], __('lang.model_deleted', ['model' => 'image']));
    }

    public function markFeatured(Product $product, MediaCenter $image)
    {
        $this->imageRepository->markFeatured($product, $image);
        return responseSuccess([], __('lang.model_featured', ['model' => 'image']));
    }
}
