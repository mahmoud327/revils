<?php

namespace App\Http\Controllers\Api\User;

use App\Exceptions\PasswordInvaild;
use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PersonalData\ChangePasswordRequest;
use App\Http\Requests\Api\PersonalData\SellerProfileRequest;
use App\Http\Requests\Api\PersonalData\CustomerProfileRequest;
use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(public UserRepositoryInterface $userRepository)
    {
    }

    public function customerUpdateProfile(CustomerProfileRequest $request)
    {
        try {
            $user = $this->userRepository->customerUpdateProfile(request: $request);
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
        return responseSuccess(UserResource::make($user));
    }
    public function sellerUpdateProfile(SellerProfileRequest $request)
    {
        try {
            $user = $this->userRepository->sellerUpdateProfile(request: $request);
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
        return responseSuccess(UserResource::make($user));
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $this->userRepository->changePassword(request: $request);
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        } catch (PasswordInvaild $ex) {
            throw new PasswordInvaild();
        }
        return responseSuccess([], 'password changes sucessfully');
    }
    public function profileInfo()
    {
        return responseSuccess(UserResource::make(auth()->user()->load(['businessProfile', 'userProfile','coins'])));
    }
}
