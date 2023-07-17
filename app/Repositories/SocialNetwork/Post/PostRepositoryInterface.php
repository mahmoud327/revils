<?php

namespace App\Repositories\SocialNetwork\Post;



interface PostRepositoryInterface
{
    public function showUserPosts(int $user_id,?int $paginatePerPage, bool $paginate =true);

}
