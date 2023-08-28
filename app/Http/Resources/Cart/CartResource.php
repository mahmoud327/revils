<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\UserResource;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "quantity" => $this->quantity,
            "user" =>  new UserResource($this->whenLoaded('user')),
            "product" =>  new ProductResource($this->whenLoaded('product')),
        ];
    }
}
