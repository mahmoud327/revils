<?php

namespace App\Http\Controllers\Api\Core;

use App\Http\Controllers\Controller;
use App\Http\Resources\Core\CountryResource;
use App\Repositories\Core\Country\CountryRepositoryInterface;
use App\Repositories\State\StateRepositoryInterface;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;



class CountryController extends Controller
{
    public function __construct(public CountryRepositoryInterface $countryRepository){}

    public function index()
    {
        $countries = CountryResource::collection($this->countryRepository->all(false,false));
        return responseSuccess($countries);
    }

    public function getStates(Request $request)
    {
        $country = $this->countryRepository->find($request->country_id);

        if(!$country)
        {
            throw new NotFoundException;
        }
        $states = $this->countryRepository->getStates($request->country_id);

        return responseSuccess($states);
    }

    public function getCities(Request $request,StateRepositoryInterface $stateRepository)
    {
        $state = $stateRepository->find($request->state_id);
        
        if(!$state)
        {
            throw new NotFoundException;
        }
        $cities = $stateRepository->getCities($request->state_id);
        
        return responseSuccess($cities);
    }

}
