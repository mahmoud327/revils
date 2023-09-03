<?php

namespace App\Repositories\Product;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function trends(?int $paginatePerPage, bool $paginate = true) : Collection | LengthAwarePaginator;
}
