<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Core\CategoryResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "user" => new UserResource($this->whenLoaded('user')),
            "category" => new CategoryResource($this->whenLoaded('category')),
            "name" => $this->name,
            "item_type"=>$this->item_type,
            "weight" => $this->weight,
            "price" => $this->price,
            "old_price" => $this->old_price,
            "quantity" => $this->quantity,
            "description" => $this->description,
            "views" => $this->views,
            "unit" => $this->unit,
            "view_number" => $this->view_number,
            "images" => $this->images,
            "status" => $this->getStatus(),
            "reason" => $this->reason,
            "rate"=>$this->rates,
            "is_free_shipping" => $this->getIsFreeShipping(),
            "cash" => $this->cash,
            "is_batteries_shipping" => $this->getIsBatteriesShipping(),
            "is_dangerous_shipping" => $this->getIsDangerousShipping(),
            "is_liquid_shipping" => $this->getIsLiquidShipping(),
            "is_handcrafted" => $this->getIsHandcrafted(),
            "check_coin" => $this->check_coin,
            'relatedProducts'=>ProductResource::collection($this->whenLoaded('relatedProducts')),
            "attributeValues" => AttributeValueResource::collection($this->attributeValues??[]),
            'rates' => RateResource::collection($this->whenLoaded('ratingsPure')),
        ];
    }
}
