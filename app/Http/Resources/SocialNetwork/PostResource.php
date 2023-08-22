<?php

namespace App\Http\Resources\SocialNetwork;

use App\Http\Resources\UserResource;
use Carbon\Carbon;
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
            "created_at" =>$this->created_at->format('Y-m-d'),
            "create_at_human" =>Carbon::parse($this->created_at)->diffForHumans(),
            "likers_count" => $this->likers_count,
            "user" => new UserResource($this->whenLoaded('user')),
            "tags" => UserResource::collection($this->whenLoaded('tags')),
            "comments" => CommentResource::collection($this->whenLoaded('comments')),
            "image" => $this->getFirstMedia()->original_url??"",
            "likers" => LikeResource::collection($this->whenLoaded('likers')),
        ];
    }
}
