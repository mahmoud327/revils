<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Http\Resources\Cart\CartResource;
use App\Services\CartService;


class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {
    }

    public function getUserCartItems()
    {
        $userCartItems = $this->cartService->getUserCartItems();
        if ($userCartItems->isEmpty()) {
            return responseSuccess('There is no items in your cart');
        }
        return responseSuccess(CartResource::collection($userCartItems));
    }

    public function addToCart(CartRequest $request)
    {
        try {
            return responseSuccess(new CartResource($this->cartService->addToCart($request)), 'added successfully');
        } catch (UnexpectedException $ex) {
            return responseError($ex->getMessage(), $ex->getCode());
        }catch (StockAvailabilityException $ex) {
            throw new StockAvailabilityException();
        }
    }

    public function updateCart(CartRequest $request)
    {
        if (!$request->decrease && !$request->increase) {
            return responseError('decrease or increase required', 200);
        }
        $shoppingCart = $this->cartService->updateCart($request);
        if (!$shoppingCart) {
            return responseError("cannot decrease", 401);
        }
        return responseSuccess(new CartResource($shoppingCart), 'updated successfully');
    }

    public function removeFromCart(CartRequest $request)
    {
        return responseSuccess(new CartResource($this->cartService->removeFromCart($request)), 'item deleted successfully');
    }
}
