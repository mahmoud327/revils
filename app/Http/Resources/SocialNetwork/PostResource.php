<?php

namespace App\Http\Resources\SocialNetwork;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            "id" => $this->id,
            "content" => $this->content,
            "user" => new UserResource($this->whenLoaded('user')),
            "tags" => UserResource::collection($this->whenLoaded('tags')),
        ];
    }
}
