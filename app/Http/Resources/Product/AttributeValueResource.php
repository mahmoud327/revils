<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Core\CategoryResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "value"=>$this->value,
            "attribute" => AttributeResource::make($this->whenLoaded('attribute')),

        ];
    }
}
