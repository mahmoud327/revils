<?php

namespace App\Repositories\Core\Country;



interface CountryRepositoryInterface
{
    public function getStates($country_id);
}
