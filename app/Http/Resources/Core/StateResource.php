<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
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
            "name" =>getTranslation(attribute_en: $this->name,attribute_ar: $this->name_ar),
            "country"=> new CountryResource($this->whenLoaded('country')),
        ];
    }
}
