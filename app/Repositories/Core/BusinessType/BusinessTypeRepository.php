<?php


namespace App\Repositories\Core\BusinessType;


use App\Models\Core\BusinessType;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BusinessTypeRepository extends BaisRepository implements BusinessTypeRepositoryInterface
{
    public function __construct(BusinessType $model)
    {
        parent::__construct($model);
    }
}
