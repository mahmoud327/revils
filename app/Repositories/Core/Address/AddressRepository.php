<?php


namespace App\Repositories\Core\Address;

use App\Exceptions\UnexpectedException;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Models\Product\Product;
use App\Models\UserAddress;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AddressRepository extends BaisRepository implements AddressRepositoryInterface
{
    public function __construct(UserAddress $model)
    {
        parent::__construct($model);
    }

    public function all(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        return   $this->model
            ->whereUserId(auth()->id())
            ->latest()
            ->get();
    }


    public function create($data): Model
    {
        try {
            return  $this->model->create($data->all());
        } catch (\Exception $e) {

            throw  new UnexpectedException($e->getMessage());
        }
    }
    public function update($id, $data): Model
    {
        try {
            return $this->model->findorfail($id)
                ->update($data->all());
        } catch (\Exception $e) {

            throw  new UnexpectedException($e->getMessage());
        }
    }
}
