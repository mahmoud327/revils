<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Core\AddressResource;
use App\Http\Resources\Core\CategoryResource;
use App\Http\Resources\Core\PaymentResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */



    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "amount" => $this->amount,
            "billing_address" => $this->billing_address,
            "user_address_id" => $this->user_address_id,
            "payment_id" => $this->payment_id,
            "order_status" => $this->order_status,
            'orderDetails' => OrderDetailResource::collection($this->orderDetails ?? []),
            'payment' => PaymentResource::make($this->whenLoaded('payment')),
            'userAddress' => AddressResource::make($this->whenLoaded('userAddress')),

        ];
    }
}
