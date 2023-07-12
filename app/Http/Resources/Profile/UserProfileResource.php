<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\Core\CityResource;
use App\Http\Resources\Core\CountryResource;
use App\Http\Resources\Core\StateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "country" => new CountryResource($this->whenLoaded('country')),
            "state" => new StateResource($this->whenLoaded('state')),
            "city" => new CityResource($this->whenLoaded('city')),
            "website" => $this->website,
            "zip_code" => $this->zip_code,
            "street1" => $this->street,
            "street2" => $this->street2,
            "bio" => $this->bio,

            "phone" => $this->phone,
            "mobile" => $this->mobile,
            "mobile_verified" => $this->mobile_verified,
            "job_title" => $this->job_title,
            "family_status" => $this->family_status,
            "gender" => $this->gender,
            "ethnicity" => $this->ethnicity,
            "Nationality" => $this->Nationality,
            "language" => $this->language,
            "major" => $this->major,
            "company_title" => $this->company_title,
            "linkedin" => $this->linkedin,
            "facebook" => $this->facebook,
            "snapchat" => $this->snapchat,
            "twitter" => $this->twitter,
            "youtube" => $this->youtube,
            "instagram" => $this->instagram,
            "display_name" => $this->display_name,
        ];
    }
}
