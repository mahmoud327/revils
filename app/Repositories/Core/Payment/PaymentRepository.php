<?php


namespace  App\Repositories\Core\Payment;

use App\Models\Core\Payment;
use App\Repositories\Base\BaisRepository;

class PaymentRepository  extends BaisRepository implements PaymentRepositoryInterface
{

    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }
}
