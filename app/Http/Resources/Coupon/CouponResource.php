<?php

namespace App\Http\Resources\Coupon;

use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            "code" => $this->code,
            "type" => $this->type,
            "value" => $this->value,
            "name" => $this->name,
        ];
    }
}
