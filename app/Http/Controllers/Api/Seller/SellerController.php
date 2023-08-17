<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repositories\Seller\SelllerRepositoryInterface;
use Illuminate\Http\Request;


class SellerController extends Controller
{
    public function __construct(public SelllerRepositoryInterface $sellerRepository)
    {
    }
    public function index(Request $request)
    {
        $products = UserResource::collection($this->sellerRepository->getSellers(paginatePerPage: $request->perPage));
        return responseSuccess($products);
    }
}
