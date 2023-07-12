<?php

namespace App\Http\Controllers\Api\Core;

use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\AddressRequest;
use App\Http\Resources\Core\AddressResource;
use App\Repositories\Core\Address\AddressRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function __construct(public AddressRepositoryInterface $addressRepository)
    {
    }

    public function index(Request $request)
    {
        $address = AddressResource::collection($this->addressRepository->all(false, false));
        return responseSuccess($address);
    }


    public function store(AddressRequest $request)
    {

        try {
            $this->addressRepository->create(data: $request->all());
            return responseSuccess([], __('lang.address.added'));
        } catch (UnexpectedException $ex) {
            return $ex->getMessage();
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }
    public function update($id, AddressRequest $request)
    {

        try {
            $this->addressRepository->update(id: $id, data:$request->all());
            return responseSuccess([], __('lang.address.updated'));
        } catch (UnexpectedException $ex) {
            return $ex->getMessage();
            Log::error($ex->getMessage());
            return responseError('Something went wrong!', 402);
        }
    }

    public function destroy($id)
    {
        $this->addressRepository->destroy(id: $id);
        return responseSuccess([], __('lang.address.deleted'));
    }
}
