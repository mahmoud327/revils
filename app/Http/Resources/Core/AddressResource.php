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
            "country" => new CityResource($this->whenLoaded('country')),
            "user" => new UserResource($this->whenLoaded('user')),
            "city" => new CountryResource($this->whenLoaded('city')),
            "state" => new StateResource($this->whenLoaded('state')),
            "note" => $this->note,
            "zipcode" => $this->zipcode,
            "address_type" => $this->address_type,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email??auth()->user()->email,
            "mobile" => $this->mobile??auth()->user()->mobile,
            "is_preferred" => $this->is_preferred,

        ];
    }
}
