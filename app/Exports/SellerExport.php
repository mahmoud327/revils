<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class SellerExport implements FromQuery
{

    use Exportable;
    public $customers;

    public function __construct(Collection $customers)
    {
        $this->customers = $customers;
    }

    public function query()
    {
        return User::whereKey($this->customers->pluck('id')->toArray());
    }
}
