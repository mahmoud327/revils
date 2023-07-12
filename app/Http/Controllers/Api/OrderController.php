<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\OrderNotAllowException;
use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\ChangeStatusOrderRequest;
use App\Http\Requests\Api\Order\OrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Product\Product;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct(public OrderRepositoryInterface $orderRepository)
    {
    }


    public function index(Request $request)
    {
        $orders = OrderResource::collection($this->orderRepository->all(paginatePerPage: $request->perPage));
        return responseSuccess($orders);
    }

    public function store(OrderRequest $request)
    {
        try {
            if (!auth()->user()->cartItems()->exists()) {
                return responseError(__('lang.carts.empty'), 402);
            }
            $this->orderRepository->create(data: $request);
            return responseSuccess([], __('lang.orders.added'));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }



    public function show($id)
    {
        try {
            $order = $this->orderRepository->show(id: $id);
            return responseSuccess(new OrderResource($order));
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        } catch (OrderNotAllowException $ex) {
            throw new OrderNotAllowException();
        }
    }

    public function changeStatus(ChangeStatusOrderRequest $request, $id)
    {
        try {
            $order = $this->orderRepository->changeStatus(request: $request, id: $id,);
            return responseSuccess(new OrderResource($order));
            
        } catch (UnexpectedException $ex) {
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }
}
