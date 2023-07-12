<?php

namespace App\Http\Controllers\Api\Core;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Core\PaymentResource;
use App\Repositories\Core\Payment\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(public PaymentRepositoryInterface $paymentRepository)
    {
    }

    public function index(Request $request)
    {
        $payments = PaymentResource::collection($this->paymentRepository->all(false, false));
        return responseSuccess($payments);
    }
}
