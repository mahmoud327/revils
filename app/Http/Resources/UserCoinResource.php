<?php

namespace App\Http\Resources;

use App\Http\Resources\Profile\BusinessProfileResource;
use App\Http\Resources\Profile\UserProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCoinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            "value" => $this->value,
            "date" => $this->date,

        ];
    }
}
