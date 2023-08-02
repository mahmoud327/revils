<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;
use App\Http\Requests\Api\Auth\OtpRequest;
use App\Http\Requests\Api\Auth\ResendOtpRequest;
use App\Http\Requests\Api\Auth\RestPassword\RestPasswordRequest;
use App\Http\Requests\Api\Auth\SellerRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserOtp;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Services\SendSmsService;
use Auth;
use Illuminate\Http\Request;
use Validator;


class AuthController extends Controller
{
    public function __construct(public AuthRepositoryInterface $authRepository)
    {
    }

    public function customerRegister(CustomerRegisterRequest $request)
    {
        try {
            $user = $this->authRepository->customerRegister($request);
            $data['user'] = new UserResource($user);
            $data['code'] = UserOtp::whereMobile($user->mobile)->first()->otp;
            return responseSuccess($data, 'Registered successfully !');
        }catch (UnexpectedException $ex)
        {
            return responseError($ex->getMessage(),402);
        }
    }

    public function sellerRegister(SellerRegisterRequest $request)
    {
        try {
            $user = $this->authRepository->sellerRegister($request);
            $data['user'] = new UserResource($user);
            $data['code'] = UserOtp::whereMobile($user->mobile)->first()->otp;
            return responseSuccess($data, 'Registered successfully !');
        } catch (UnexpectedException $ex) {
            return responseError($ex->getMessage(), $ex->getCode());
        }
    }

    public function validateUniqueUserNameOrEmail(Request $request)
    {
        if ($request->email && $request->username) {
            $validator = Validator::make($request->all(), [
                'email' => ['unique:users,email'],
                'username' => ['unique:users,username'],
            ]);
            if (!$validator->errors()->isEmpty()) {
                $errors = array();
                foreach ($validator->errors()->messages() as $key => $message) {
                    $errors[$key] = $message[0];
                }
                return responseError($errors, 200);
            } else {
                return responseSuccess('valid email and username');
            }
        }

        if ($request->email || $request->username) {
            if ($request->email) {
                $validator = Validator::make($request->all(), [
                    'email' => ['unique:users,email'],
                ]);
                if (!$validator->errors()->isEmpty()) {
                    $errors = array();
                    foreach ($validator->errors()->messages() as $key => $message) {
                        $errors[$key] = $message[0];
                    }
                    return responseError($errors, 200);
                } else {
                    return responseSuccess('valid email');
                }
            } else if ($request->username) {
                $validator = Validator::make($request->all(), [
                    'username' => ['unique:users,username'],
                ]);
                if (!$validator->errors()->isEmpty()) {
                    $errors = array();
                    foreach ($validator->errors()->messages() as $key => $message) {
                        $errors[$key] = $message[0];
                    }
                    return responseError($errors, 200);
                } else {
                    return responseSuccess('valid username');
                }
            }
        }
        return responseError('please provide at least email or username', 200);
    }



    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return responseError($validator->errors(), 400);
            }

            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                $authUser = Auth::user();
                $success['token'] = $authUser->createToken('sanctumAuth')->plainTextToken;
                $success['user'] = new UserResource($authUser);
                return responseSuccess($success);
            } else {
                return responseError("Username or Password is wrong", 402);
            }
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function verifyMobileSms(OtpRequest $request)
    {
        $otp = new SendSmsService();
        $otp->setOtp(otp: $request->otp);
        $verification = $otp->verifyOtp();
        if(!$verification)
        {
            return responseError("wrong code !", 402);
        }
        return responseSuccess('','valid code');
    }

    public function resendOtp(ResendOtpRequest $request)
    {
        $otp = new SendSmsService();
        $otp->setMobile(mobile: $request->mobile);
        $otp->deleteOldOtpCodes(mobile: $request->mobile);
        $otp->sendSmsOtp();
        $code['code'] = UserOtp::whereMobile($request->mobile)->first()->otp;

        return responseSuccess($code,'Otp is sent');
    }

    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return responseSuccess('', 'Logged out successfully');
    }


}
