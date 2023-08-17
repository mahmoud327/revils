<?php

namespace App\Http\Resources;

use App\Http\Resources\Profile\BusinessProfileResource;
use App\Http\Resources\Profile\UserProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "first_name" => $this->first_name,
            "last_name" => $this->first_name,
            "username" => $this->username,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "coverImage"=>$this->cover_image,
            "profileImage"=>$this->profile_image,
            "account_type" => $this->account_type ? "seller" : "customer",
            "profile" =>  $this->account_type ? new BusinessProfileResource($this->whenLoaded('businessProfile')) : new UserProfileResource($this->whenLoaded('userProfile')),
            "coin" =>UserCoinResource::make($this->whenLoaded('userCoinEarn'))
        ];
    }
}
