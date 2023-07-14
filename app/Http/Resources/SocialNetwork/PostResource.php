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
            "user" => new UserResource($this->whenLoaded('user')),
            "content" => $this->content,
            "tags" => UserResource::collection($this->whenLoaded('tags')),
        ];
    }
}
