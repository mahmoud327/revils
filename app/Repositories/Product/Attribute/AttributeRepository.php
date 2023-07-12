<?php


namespace App\Repositories\Product\Attribute;

use App\Models\Product\Attribute;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


class AttributeRepository extends BaisRepository implements AttributeRepositoryInterface
{
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }
    public function all(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        return   $this->model->with('attributeValues')
            ->latest()
            ->get();
    }
}
