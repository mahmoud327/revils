<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            "username" => optional($this->user)->username,
            "profile_image" => optional($this->user)->profile_image,
            "rate_value" => $this->relation_value,
            "comment" => $this->relation_type,
        ];
    }
}
