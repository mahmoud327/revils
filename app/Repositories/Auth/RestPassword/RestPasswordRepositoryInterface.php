<?php

namespace App\Repositories\Auth\RestPassword;


use App\Http\Requests\Api\Auth\OtpRequest;
use App\Http\Requests\Api\Auth\RestPassword\ChangePasswordRequest;
use App\Http\Requests\Api\Auth\RestPassword\RestPasswordRequest;

interface RestPasswordRepositoryInterface
{
    public function sendOtp(RestPasswordRequest $request);

    public function verifyOtp(OtpRequest $request);
    public function changePassword(ChangePasswordRequest $request);
}
