<?php

namespace App\Exceptions;

use Exception;

class StockAvailabilityException extends Exception
{
    public function render()
    {
        return responseError('Not available in the stock',408);
    }
}
