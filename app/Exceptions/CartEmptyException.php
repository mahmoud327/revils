<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CartEmptyException extends Exception
{
    public function render()
    {
        return responseError('order not allow',408);
    }
}
