<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaCenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->resource->id,
            'original'    => $this->resource->getUrl(),
            'order'       => $this->resource->order_column,
            'position'       => $this->resource->order_column,
            'is_featured' => $this->resource->getCustomProperty('isFeatured', false),
        ];
    }
}
