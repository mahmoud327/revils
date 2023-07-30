<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\OtpRequest;
use App\Http\Requests\Api\Auth\RestPassword\ChangePasswordRequest;
use App\Http\Requests\Api\Auth\RestPassword\RestPasswordRequest;
use App\Models\UserOtp;
use App\Repositories\Auth\RestPassword\RestPasswordRepositoryInterface;
use App\Services\SendSmsService;

class ResetPasswordController extends Controller
{
    public function __construct(public  RestPasswordRepositoryInterface $restPasswordRepository){}
    public function sendOtp(RestPasswordRequest $request)
    {
        $this->restPasswordRepository->sendOtp(request: $request);
        $code['code'] = UserOtp::whereMobile($request->mobile)->first()->otp;
        return responseSuccess($code, 'Code is sent successfully, please check your mobile messages');
    }

    public function verifyOtp(OtpRequest $request)
    {
        $otp = new SendSmsService();
        $otp->setOtp(otp: $request->otp);
        $verification = $otp->verifyRestPassOtp();
        if(!$verification)
        {
            return responseError("wrong code !", 402);
        }
        return responseSuccess('','valid code');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $reset = $this->restPasswordRepository->changePassword(request: $request);
        if(!$reset)
        {
            return responseError("Wrong code !", 402);
        }
        return responseSuccess('', 'Your password changed successfully');
    }
}
