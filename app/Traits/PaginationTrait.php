<?php


// app/Traits/PaginationTrait.php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

trait PaginationTrait
{
    protected function buildPaginationMeta($paginator)
    {
        return [
            'current_page' => $paginator->currentPage(),
            'from' => $paginator->firstItem(),
            'last_page' => $paginator->lastPage(),
            'path' => $paginator->resolveCurrentPath(),
            'per_page' => $paginator->perPage(),
            'to' => $paginator->lastItem(),
            'total' => $paginator->total(),
        ];
    }
}
