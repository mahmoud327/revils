<?php


namespace App\Repositories\Seller;

use App\Exceptions\UnexpectedException;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Models\Product\Product;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SellerRepository extends BaisRepository implements SelllerRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
    public function getProducts(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        $products = $this->model
            ->whereUserId(auth()->id())
            ->with(['category', 'attributes'])
            ->latest();
        $products->filter($products);
        if ($paginate) {
            if ($paginatePerPage) {
                return $products->paginate($paginatePerPage);
            }
            return $products->paginate();
        }

        return $products->get();
    }
}
