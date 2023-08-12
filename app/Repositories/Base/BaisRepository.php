<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaisRepository implements BaseRepositoryInterface
{
    public function __construct(public Model $model){}

    public function all(?int $paginatePerPage,bool $paginate = true) : Collection | LengthAwarePaginator
    {
        if($paginate)
        {
            if($paginatePerPage)
            {
                return $this->model->latest()->paginate($paginatePerPage);
            }
            return $this->model->latest()->paginate();
        }

        return $this->model->latest()->get();
    }

    public function create($data) : Model
    {
        return $this->model->create($data);
    }

    public function update($id,$data)
    {
        return $this->model->whereId($id)->update($data);
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function destroy($id): bool
    {
         return $this->find($id)->delete();
    }

}
