<?php

namespace App\Repositories\SocialNetwork\Post;



use App\Models\SocialNetwork\Post;

interface PostRepositoryInterface
{
    public function showUserPosts(int $user_id,?int $paginatePerPage, bool $paginate =true);
    public function likeOrUnlikePost(Post $post);
}
