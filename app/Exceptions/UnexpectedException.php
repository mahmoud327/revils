<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UnexpectedException extends Exception
{
    public function render()
    {
        return responseError($this->getMessage(), ResponseAlias::HTTP_BAD_REQUEST);
    }
}
