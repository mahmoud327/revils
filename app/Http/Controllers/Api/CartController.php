<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\StockAvailabilityException;
use App\Exceptions\UnexpectedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Http\Requests\Api\Cart\RemoveCartRequest;
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
        if (!$userCartItems) {
            return responseSuccess('There is no items in your cart');
        }
        return responseSuccess($userCartItems);
    }

    public function addToCart(CartRequest $request)
    {
        try {
            $data = $this->cartService->addToCart($request);
            return responseSuccess($data, 'added successfully');
        } catch (UnexpectedException $ex) {
            return responseError($ex->getMessage(), $ex->getCode());
        }catch (StockAvailabilityException $ex) {
            throw new StockAvailabilityException();
        }
    }

    public function updateCart(CartRequest $request)
    {
        if (!$request->decrease && !$request->increase)
        {
            return responseError('decrease or increase required', 200);
        }
        $shoppingCart = $this->cartService->updateCart($request);
        if (!$shoppingCart) {
            return responseError("cannot decrease", 401);
        }
        return responseSuccess($shoppingCart, 'updated successfully');
    }

    public function removeFromCart(RemoveCartRequest $request)
    {
        return responseSuccess($this->cartService->removeFromCart($request), 'item deleted successfully');
    }
}
