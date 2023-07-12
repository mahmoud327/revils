<?php

namespace App\Repositories\Order;



interface OrderRepositoryInterface{
    public function changeStatus($request,$id);
}

