<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coupon\CouponRequest;
use App\Http\Resources\Coupon\CouponResource;
use App\Models\Core\CouponUser;
use App\Repositories\Core\Coupon\CouponRepositoryInterface;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(public CouponRepositoryInterface $couponRepository)
    {
    }

    public function verifyCoupon(CouponRequest $request)
    {

        $coupon = $this->couponRepository->verifyCoupon($request);

        if (!$coupon) {
            return responseError(__('lang.coupons.expired'), 402);
        }

        if ($coupon->userUsedCoupon) {
            return responseError(__('lang.coupons.used'), 402);
        }
        return responseSuccess(new CouponResource($coupon), __('lang.coupons.valid'));
    }
}
