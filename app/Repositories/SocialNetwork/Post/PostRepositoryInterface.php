<?php

namespace App\Repositories\SocialNetwork\Post;



use App\Models\SocialNetwork\Post;

interface PostRepositoryInterface
{
    public function likeOrUnlikePost(Post $post);
    public function favoriteOrUnfavorit(Post $post);

}
