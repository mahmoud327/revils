<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "code" => $this->code,
            "phonecode" => $this->phonecode,
            "flag" => asset('vendor/blade-flags/country-'.$this->code.'.svg')
        ];
    }
}
