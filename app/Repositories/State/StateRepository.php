<?php


namespace App\Repositories\State;

use App\Models\Core\State;
use App\Repositories\Base\BaisRepository;

class StateRepository extends BaisRepository implements StateRepositoryInterface
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }

    public function getCities($state_id)
    {
        $state = $this->find($state_id)->load('cities');
        return $state->cities;
    }
}
