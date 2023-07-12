<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class PasswordInvaild extends Exception
{
    public function render()
    {
        return responseError('password not correct',408);
    }
}
