<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class OrderNotAllowException extends Exception
{
    public function render()
    {
        return responseError('order not allow',408);
    }
}
