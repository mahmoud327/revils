<?php


namespace App\Repositories\Auth;


use App\Exceptions\UnexpectedException;
use App\Http\Requests\Api\Auth\CustomerRegisterRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\SellerRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\SendSmsService;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthRepository implements AuthRepositoryInterface
{
    public function __construct(public User $model)
    {
    }

    public function login(LoginRequest $request)
    {
        // TODO: Implement login() method.
    }

    public function customerRegister(CustomerRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['password'=>bcrypt($request->password)]);
            $user = $this->model::create($request->except('agreement'));
            $user->assignRole($this->model::CUSTOMER);
            $sms = new SendSmsService();
            $sms->setMobile(mobile: $user->mobile);
            $sms->sendSmsOtp();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            Log::warning($e);
            throw new UnexpectedException($e->getMessage());
        }
    }

    public function sellerRegister(SellerRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['password'=>bcrypt($request->password)]);
            $user = $this->model::create($request->all());
            $user->assignRole($this->model::SELLER);
            $sms = new SendSmsService();
            $sms->setMobile(mobile: $user->mobile);
            $sms->sendSmsOtp();
            $this->createBusinessProfile($user, $request);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            Log::warning($e);
            throw new UnexpectedException($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
        return new UserResource($user->load('businessProfile'));
    }

    public function createBusinessProfile($user, $request)
    {
        $user->businessProfile()->create([
            'display_name' => $request->store_name,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
            'zipcode' => $request->zipcode,
            'street' => $request->area,
            'street2' => $request->street2
        ]);
    }
}
