<?php

namespace App\Http\Resources\Core;

use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            "address" => $this->address,
            "country_id" => $this->country_id,
            "state_id" => $this->state_id,
            "city_id" => $this->state_id,
            "note" => $this->note,
            "zipcode" => $this->zipcode,
            "address_type" => $this->address_type,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "is_preferred" => $this->is_preferred,

        ];
    }
}
