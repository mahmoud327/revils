<?php


namespace App\Repositories\Core\Banner;

use App\Models\Core\Banner;
use App\Repositories\Base\BaisRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class   BannerRepository extends BaisRepository implements BannerRepositoryInterface
{
    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }

    public function all(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        return   $this->model->active()->latest()->get();
    }
}
