<?php

namespace App\Repositories\Seller;



interface SelllerRepositoryInterface
{
    public function getProducts(int $paginatePerPage, bool $paginate = true);
}
