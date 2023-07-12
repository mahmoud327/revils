<?php


namespace App\Repositories\Core\Country;

use App\Models\Core\Country;
use App\Repositories\Base\BaisRepository;

class CountryRepository extends BaisRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function getStates($country_id)
    {
        $country = $this->find($country_id)->load('states');
        return $country->states;
    }
}
