<?php

namespace App\Repositories\Auth;


use App\Http\Requests\Api\Auth\CusRegisterRequest;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\SellerRegisterRequest;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $request);
    public function customerRegister(CusRegisterRequest $request);
    public function sellerRegister(SellerRegisterRequest $request);
}
