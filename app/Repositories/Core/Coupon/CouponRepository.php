<?php


namespace App\Repositories\Core\Coupon;

use App\Models\Core\Coupon;
use App\Repositories\Base\BaisRepository;

class CouponRepository extends BaisRepository implements CouponRepositoryInterface
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }

    public function verifyCoupon($coupon)
    {
          return $this->model->query()
            ->whereCode($coupon)
            ->vaild()
            ->first();
    }
}
