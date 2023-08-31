<?php


// app/Traits/PaginationTrait.php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

trait PaginationTrait
{
    protected function paginateResourceCollection(ResourceCollection $resourceCollection)
    {
        $perPage = request('per_page', 10);
        return $resourceCollection->additional([
            'meta' => [
                'pagination' => [
                    'total' => $resourceCollection->total(),
                    'per_page' => $perPage,
                    'current_page' => $resourceCollection->currentPage(),
                    'last_page' => $resourceCollection->lastPage(),
                    // You can include more pagination details if needed
                ],
            ],
        ]);
    }
}
