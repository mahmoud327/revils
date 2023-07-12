<?php


namespace App\Repositories\Core\Category;


use App\Models\Core\Category;
use App\Repositories\Base\BaisRepository;

class CategoryRepository extends BaisRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
