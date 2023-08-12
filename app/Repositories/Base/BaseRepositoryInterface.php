<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function all(?int $paginatePerPage,bool $paginate =true);
    public function create($data): Model;
    public function update(int $id,$data);
    public function find(int $id): ?Model;
    public function destroy(int $id): bool;
}
