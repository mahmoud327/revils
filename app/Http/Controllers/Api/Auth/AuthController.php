<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;
use App\Http\Requests\Api\Auth\SellerRegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Auth\AuthRepositoryInterface;
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
            return $user = $this->authRepository->customerRegister($request);
        } catch (UnexpectedException $ex) {
            return responseError($ex->getMessage(), $ex->getCode());
        }
        return responseSuccess($user, 'Registered successfully!', 200);
    }

    public function sellerRegister(SellerRegisterRequest $request)
    {
        try {
            $user = $this->authRepository->sellerRegister($request);
            return responseSuccess($user, 'Registered successfully!');
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


    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return responseSuccess('', 'Logged out successfully');
    }
}
