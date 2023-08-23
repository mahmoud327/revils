<?php

namespace App\Http\Resources\SocialNetwork;

use App\Http\Resources\UserResource;
use App\Models\SocialNetwork\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            "has_liked" => Auth::user()->hasLiked(Post::find($this->id)),
            "has_favorited" => Auth::user()->hasFavorited(Post::find($this->id)),
            "user" => new UserResource($this->whenLoaded('user')),
            "tags" => UserResource::collection($this->whenLoaded('tags')),
            "comments" => CommentResource::collection($this->whenLoaded('comments')),
            "image" => $this->getFirstMedia()->original_url??"",
            "likers" => LikeResource::collection($this->whenLoaded('likers')),
        ];
    }
}
