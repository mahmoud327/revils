<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UnexpectedException extends Exception
{
    public function render()
    {
        return responseError($this->getMessage(),Response::HTTP_BAD_REQUEST);
    }
}
