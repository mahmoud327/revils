<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\AttributeResource;
use App\Repositories\Product\Attribute\AttributeRepositoryInterface;
use Illuminate\Http\Request;


class AttributeController extends Controller
{
    public function __construct(public  AttributeRepositoryInterface $attributeRepository)
    {
    }

    public function index(Request $request)
    {

        $attributes = $this->attributeRepository->all(false, false);;
        return responseSuccess(AttributeResource::collection($attributes));
    }
}
