<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Http\Resources\Core\BannerResource;
use App\Repositories\Core\Banner\BannerRepositoryInterface;

class BannerController extends Controller
{
    public function __construct(public BannerRepositoryInterface $bannerRepository){}

    public function index()
    {
        $banners = BannerResource::collection($this->bannerRepository->all(false,false));
        return responseSuccess($banners);
    }



}
