<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Http\Resources\Core\BusinessTypeResource;
use App\Repositories\Core\BusinessType\BusinessTypeRepositoryInterface;


class BusinessTypeController extends Controller
{
    public function __construct(public BusinessTypeRepositoryInterface $businessTypeRepository){}

    public function index()
    {
        $businessTypes = $this->businessTypeRepository->all(false,false);;

        return responseSuccess(BusinessTypeResource::collection($businessTypes));
    }
}
