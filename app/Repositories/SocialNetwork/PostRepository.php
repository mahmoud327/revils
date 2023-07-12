<?php


namespace App\Repositories\SocialNetwork;

use App\Models\SocialNetwork\Post;
use App\Repositories\Base\BaisRepository;

class PostRepository extends BaisRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}
