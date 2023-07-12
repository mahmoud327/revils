<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Http\Resources\Core\CategoryResource;
use App\Repositories\Core\Category\CategoryRepositoryInterface;


class CategoryController extends Controller
{
    public function __construct(public CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function index()
    {
        $categories = $this->categoryRepository->all(false, false);;
        return responseSuccess(CategoryResource::collection($categories));
    }
}
