<?php


namespace App\Repositories\Seller;


use App\Models\Product\Product;
use App\Models\User;
use App\Repositories\Base\BaisRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\UserTypesEnum;

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

    public function getSellers(?int $paginatePerPage, bool $paginate = true): Collection | LengthAwarePaginator
    {
        $sellerModel = User::seller();
        $sellerModel->filter($sellerModel);
        if ($paginate) {
            if ($paginatePerPage) {
                return $sellerModel->paginate($paginatePerPage);
            }
            return $sellerModel->paginate();
        }

        return $sellerModel->get();
    }
}
