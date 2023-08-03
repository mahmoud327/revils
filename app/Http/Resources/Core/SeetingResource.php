<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeetingResource extends JsonResource
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
            "phone" => $this->phone,
            "email" => $this->email,
            "address" => $this->address,
            "whatsapp" => $this->whatsapp,
            "tw_link" => $this->tw_link,
            "linkedin_link" => $this->linkedin_link,
            "inst_link" => $this->inst_link,
            "skype_link" => $this->skype_link,
            "terms_condition" => $this->terms_condition,
        ];
    }
}
