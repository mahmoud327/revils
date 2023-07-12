<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Core\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "price" => $this->price,
            "quantity" => $this->quantity,
            "order_id" => $this->order_id,
            "product_id" => $this->product_id,
            "product" => ProductResource::make($this->whenLoaded('product'))
        ];
    }
}
